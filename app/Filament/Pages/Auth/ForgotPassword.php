<?php

namespace App\Filament\Pages\Auth;

use DanHarrin\LivewireRateLimiter\Exceptions\TooManyRequestsException;
use Filament\Facades\Filament;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Auth\ForgotPassword as BaseForgotPassword;
use Illuminate\Support\Facades\Password;

class ForgotPassword extends BaseForgotPassword
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                $this->getEmailFormComponent(),
            ])
            ->statePath('data');
    }

    protected function getEmailFormComponent(): TextInput
    {
        return TextInput::make('email')
            ->label(__('filament-panels::pages/auth/forgot-password.form.email.label'))
            ->email()
            ->required()
            ->autofocus();
    }

    public function sendPasswordResetLink(): void
    {
        try {
            $this->rateLimit(2);
        } catch (TooManyRequestsException $exception) {
            Notification::make()
                ->title(__('filament-panels::pages/auth/forgot-password.notifications.throttled.title', [
                    'seconds' => $exception->secondsUntilAvailable,
                    'minutes' => ceil($exception->secondsUntilAvailable / 60),
                ]))
                ->body(__('filament-panels::pages/auth/forgot-password.notifications.throttled.body', [
                    'seconds' => $exception->secondsUntilAvailable,
                    'minutes' => ceil($exception->secondsUntilAvailable / 60),
                ]))
                ->danger()
                ->send();

            return;
        }

        $data = $this->form->getState();

        $status = Password::broker(Filament::getAuthPasswordBroker())
            ->sendResetLink(
                $data,
                function ($user, $token) {
                    if (! method_exists($user, 'notify')) {
                        $userClass = $user::class;

                        throw new \Exception("Model [{$userClass}] does not have a [notify()] method.");
                    }

                    $notification = new \Illuminate\Auth\Notifications\ResetPassword($token);
                    $user->notify($notification);
                },
            );

        if ($status !== Password::RESET_LINK_SENT) {
            Notification::make()
                ->title(__("filament-panels::pages/auth/forgot-password.notifications.{$status}.title"))
                ->body(__("filament-panels::pages/auth/forgot-password.notifications.{$status}.body"))
                ->danger()
                ->send();

            return;
        }

        $this->form->fill();

        Notification::make()
            ->title(__('filament-panels::pages/auth/forgot-password.notifications.reset_link_sent.title'))
            ->body(__('filament-panels::pages/auth/forgot-password.notifications.reset_link_sent.body'))
            ->success()
            ->send();
    }
} 