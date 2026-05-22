<?php

namespace App\Livewire\Features\Settings;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Email extends Component
{
    public string $currentEmail = '';
    public string $email = '';
    public string $current_password = '';

    public bool $saved = false;
    public bool $submitted = false;

    public function mount(): void
    {
        $user = Auth::user();

        $this->currentEmail = $user->email;
        $this->email = $user->email;
    }

    public function updateEmail(): void
    {
        $user = Auth::user();
        $this->saved = false;
        $this->submitted = true;
        $this->email = trim($this->email);

        $validated = $this->validate([
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'different:currentEmail',
                Rule::unique(User::class)->ignore($user->id),
            ],
            'current_password' => ['required', 'string', 'current_password:web'],
        ], [
            'email.different' => '現在のメールアドレスとは別のメールアドレスを入力してください。',
        ]);

        $oldEmail = $user->email;

        $user->forceFill([
            'email' => $validated['email'],
            'email_verified_at' => null,
        ])->save();

        DB::table('password_reset_tokens')->where('email', $oldEmail)->delete();

        $user->sendEmailVerificationNotification();

        $this->currentEmail = $user->email;
        $this->reset('current_password');
        $this->saved = true;
    }

    public function render(): View
    {
        return view('livewire.features.settings.email');
    }
}
