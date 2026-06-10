<?php

namespace App\Livewire\Features\User;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
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

    public function privateMessage(): string
    {
        return $this->type === 'followers'
            ? 'このユーザーのフォロワーは非公開です。'
            : 'このユーザーのフォローは非公開です。';
    }

    public function render(): View
    {
        $canViewList = $this->user->canBeViewedBy(Auth::user());

        $users = $canViewList
            ? $this->user->{$this->type}()
                ->orderBy('screen_name')
                ->get()
            : collect();

        return view('livewire.features.user.follow-list', [
            'canViewList' => $canViewList,
            'users' => $users,
        ]);
    }
}
