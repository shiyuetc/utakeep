<?php

namespace App\Livewire\Features\User;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
    
class ProfileCard extends Component
{
    public ?string $activeRouteName = null;

    public ?int $activeStatus = null;

    public ?string $activeScreenName = null;

    public function mount(): void
    {
        $routeUser = request()->route('user');

        $this->activeRouteName = request()->route()?->getName();
        $this->activeStatus = $this->activeRouteName === 'users.show.status'
            ? (int) request()->route('status')
            : null;
        $this->activeScreenName = $routeUser instanceof User ? $routeUser->screen_name : $routeUser;
    }

    #[On('profile-updated')]
    #[On('status-updated')]
    public function refreshUser(): void
    {
    }

    public function render(): View
    {
        $user = Auth::user()->fresh();

        return view('livewire.features.user.profile-card', [
            'user' => $user,
            'isOwnProfileRoute' => $this->activeScreenName === $user->screen_name,
        ]);
    }
}
