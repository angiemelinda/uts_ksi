<?php

namespace App\Filament\Pages\Auth;

use DanHarrin\LivewireRateLimiter\Exceptions\TooManyRequestsException;
use Filament\Facades\Filament;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Http\Responses\Auth\Contracts\RegistrationResponse;
use Filament\Notifications\Notification;
use Filament\Pages\Auth\Register as BaseRegister;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class Register extends BaseRegister
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Name')
                    ->required()
                    ->maxLength(255)
                    ->autofocus(),
                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->unique(table: $this->getUserModel()),
                TextInput::make('password')
                    ->label('Password')
                    ->password()
                    ->required()
                    ->rule(Password::default())
                    ->revealable(filament()->arePasswordsRevealable())
                    ->same('passwordConfirmation'),
                TextInput::make('passwordConfirmation')
                    ->label('Password Confirmation')
                    ->password()
                    ->required()
                    ->revealable(filament()->arePasswordsRevealable())
                    ->dehydrated(false),
            ])
            ->statePath('data');
    }

    protected function getUserModel(): string
    {
        return userModelClass();
    }

    public function register(): ?RegistrationResponse
    {
        try {
            $this->rateLimit(5);
        } catch (TooManyRequestsException $exception) {
            Notification::make()
                ->title(__('filament-panels::pages/auth/register.notifications.throttled.title', [
                    'seconds' => $exception->secondsUntilAvailable,
                    'minutes' => ceil($exception->secondsUntilAvailable / 60),
                ]))
                ->body(__('filament-panels::pages/auth/register.notifications.throttled.body', [
                    'seconds' => $exception->secondsUntilAvailable,
                    'minutes' => ceil($exception->secondsUntilAvailable / 60),
                ]))
                ->danger()
                ->send();

            return null;
        }

        $data = $this->form->getState();

        $user = $this->getUserModel()::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'staff', // Default role for new users
        ]);

        $this->sendEmailVerificationNotification($user);

        Filament::auth()->login($user);

        return app(RegistrationResponse::class);
    }

    protected function sendEmailVerificationNotification(Model $user): void
    {
        if (! $user instanceof Model) {
            return;
        }

        if (! method_exists($user, 'notify')) {
            return;
        }

        if (! method_exists($user, 'shouldSendEmailVerificationNotification') && 
            (! auth()->hasUser() || $user->getAuthIdentifier() !== auth()->id())) {
            return;
        }

        if (
            method_exists($user, 'shouldSendEmailVerificationNotification') &&
            ! $user->shouldSendEmailVerificationNotification()
        ) {
            return;
        }

        $notification = new \Illuminate\Auth\Notifications\VerifyEmail();
        $user->notify($notification);
    }
} 