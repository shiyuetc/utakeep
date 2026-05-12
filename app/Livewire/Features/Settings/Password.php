<?php

namespace App\Livewire\Features\Settings;

use App\Actions\Fortify\PasswordValidationRules;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Password extends Component
{
    use PasswordValidationRules;

    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    public bool $saved = false;
    public bool $submitted = false;

    public function updatePassword(): void
    {
        $this->saved = false;
        $this->submitted = true;

        $validated = $this->validate([
            'current_password' => ['required', 'string', 'current_password:web'],
            'password' => $this->passwordRules(),
        ]);

        Auth::user()->forceFill([
            'password' => Hash::make($validated['password']),
        ])->save();

        $this->reset('current_password', 'password', 'password_confirmation');
        $this->saved = true;
    }

    public function render(): View
    {
        return view('livewire.features.settings.password');
    }
}
