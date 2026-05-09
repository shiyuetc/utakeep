<?php

namespace App\Livewire\Features\Settings;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Withdrawal extends Component
{
    public string $deletePassword = '';
    public bool $submitted = false;

    public function deleteAccount(): void
    {
        $this->submitted = true;

        if (! $this->validateDeletePassword()) {
            return;
        }

        $this->dispatch('confirm-account-deletion');
    }

    public function deleteConfirmed()
    {
        if (! $this->validateDeletePassword()) {
            return;
        }

        $user = Auth::user();

        DB::transaction(function () use ($user): void {
            $userId = $user->id;
            $email = $user->email;

            DB::table('password_reset_tokens')->where('email', $email)->delete();
            DB::table('sessions')->where('user_id', $userId)->delete();
            $user->delete();
        });

        Auth::guard('web')->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return $this->redirectRoute('home', navigate: true);
    }

    private function validateDeletePassword(): bool
    {
        $this->resetErrorBag('deletePassword');

        $this->validate(
            ['deletePassword' => ['required', 'string']],
            ['deletePassword.required' => 'パスワードを入力してください。']
        );

        $user = Auth::user();

        if (! Hash::check($this->deletePassword, $user->password)) {
            $this->addError('deletePassword', 'パスワードが正しくありません。');
            return false;
        }

        return true;
    }

    public function render(): View
    {
        return view('livewire.features.settings.withdrawal');
    }
}
