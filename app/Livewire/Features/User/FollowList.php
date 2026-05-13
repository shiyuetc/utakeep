<?php

namespace App\Livewire\Features\User;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class FollowList extends Component
{
    public User $user;

    public string $type;

    public function mount(User $user, string $type): void
    {
        $this->user = $user;
        $this->type = in_array($type, ['following', 'followers'], true) ? $type : 'following';
    }

    public function title(): string
    {
        return $this->type === 'followers' ? 'フォロワー' : 'フォロー';
    }

    public function emptyMessage(): string
    {
        return $this->type === 'followers'
            ? 'フォロワーはいません。'
            : 'フォロー中のユーザーはいません。';
    }

    public function render(): View
    {
        $users = $this->user->{$this->type}()
            ->orderBy('screen_name')
            ->get();

        return view('livewire.features.user.follow-list', [
            'users' => $users,
        ]);
    }
}
