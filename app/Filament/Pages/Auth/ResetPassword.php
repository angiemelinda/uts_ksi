<?php

namespace App\Filament\Pages\Auth;

use DanHarrin\LivewireRateLimiter\Exceptions\TooManyRequestsException;
use Filament\Facades\Filament;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Http\Responses\Auth\Contracts\PasswordResetResponse;
use Filament\Notifications\Notification;
use Filament\Pages\Auth\ResetPassword as BaseResetPassword;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password as PasswordRule;

class ResetPassword extends BaseResetPassword
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('email')
                    ->label(__('filament-panels::pages/auth/reset-password.form.email.label'))
                    ->email()
                    ->required()
                    ->autofocus(),
                TextInput::make('password')
                    ->label(__('filament-panels::pages/auth/reset-password.form.password.label'))
                    ->password()
                    ->required()
                    ->rule(PasswordRule::default())
                    ->revealable(filament()->arePasswordsRevealable())
                    ->same('passwordConfirmation'),
                TextInput::make('passwordConfirmation')
                    ->label(__('filament-panels::pages/auth/reset-password.form.password_confirmation.label'))
                    ->password()
                    ->required()
                    ->revealable(filament()->arePasswordsRevealable())
                    ->dehydrated(false),
            ])
            ->statePath('data');
    }

    public function resetPassword(): ?PasswordResetResponse
    {
        try {
            $this->rateLimit(2);
        } catch (TooManyRequestsException $exception) {
            Notification::make()
                ->title(__('filament-panels::pages/auth/reset-password.notifications.throttled.title', [
                    'seconds' => $exception->secondsUntilAvailable,
                    'minutes' => ceil($exception->secondsUntilAvailable / 60),
                ]))
                ->body(__('filament-panels::pages/auth/reset-password.notifications.throttled.body', [
                    'seconds' => $exception->secondsUntilAvailable,
                    'minutes' => ceil($exception->secondsUntilAvailable / 60),
                ]))
                ->danger()
                ->send();

            return null;
        }

        $data = $this->form->getState();

        $data['token'] = $this->token;

        $status = Password::broker(Filament::getAuthPasswordBroker())->reset(
            $data,
            function ($user) use ($data) {
                $user->forceFill([
                    'password' => Hash::make($data['password']),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            },
        );

        if ($status !== Password::PASSWORD_RESET) {
            Notification::make()
                ->title(__("filament-panels::pages/auth/reset-password.notifications.{$status}.title"))
                ->body(__("filament-panels::pages/auth/reset-password.notifications.{$status}.body"))
                ->danger()
                ->send();

            return null;
        }

        return app(PasswordResetResponse::class);
    }
} 