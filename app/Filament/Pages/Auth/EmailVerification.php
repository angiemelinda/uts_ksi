<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Auth\EmailVerification as BaseEmailVerification;
use Illuminate\Support\Facades\DB;

class EmailVerification extends BaseEmailVerification
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                $this->getCodeFormComponent(),
            ]);
    }

    protected function getCodeFormComponent(): TextInput
    {
        return TextInput::make('code')
            ->label(__('filament-panels::pages/auth/email-verification.form.code.label'))
            ->placeholder(__('filament-panels::pages/auth/email-verification.form.code.placeholder'))
            ->hint(__('filament-panels::pages/auth/email-verification.form.code.hint', ['email' => auth()->user()?->email]))
            ->numeric()
            ->required()
            ->autofocus()
            ->autocomplete('one-time-code')
            ->validationAttribute(__('filament-panels::pages/auth/email-verification.form.code.validation_attribute'));
    }
} 