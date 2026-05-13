<?php

namespace App\Livewire\Features\User;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Search extends Component
{
    public string $term = '';
    public bool $searched = false;

    public function search(): void
    {
        $this->validate([
            'term' => ['required', 'string', 'min:1'],
        ]);

        $this->searched = true;
    }

    public function render(): View
    {
        $users = collect();
        $viewer = Auth::user();

        if ($this->searched) {
            $query = User::query()
                ->where('screen_name', 'like', "%{$this->term}%")
                ->orWhere('name', 'like', "%{$this->term}%")
                ->orderBy('screen_name')
                ->limit(30);

            if ($viewer) {
                $query->withExists([
                    'following as is_followed_by_viewer' => fn ($query) => $query->whereKey($viewer->id),
                ]);
            }

            $users = $query->get();
        }

        return view('livewire.features.user.search', [
            'users' => $users,
        ]);
    }
}
