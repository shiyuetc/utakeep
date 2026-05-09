<?php

namespace App\Livewire\Features\User;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
    
class ProfileCard extends Component
{
    #[On('profile-updated')]
    public function refreshUser(): void
    {
    }

    public function render(): View
    {
        return view('livewire.features.user.profile-card', [
            'user' => Auth::user()?->fresh(),
        ]);
    }
}
