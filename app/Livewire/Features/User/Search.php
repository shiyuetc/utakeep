<?php

namespace App\Livewire\Features\User;

use App\Models\User;
use Illuminate\Contracts\View\View;
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

        if ($this->searched) {
            $users = User::query()
                ->where('screen_name', 'like', "%{$this->term}%")
                ->orWhere('name', 'like', "%{$this->term}%")
                ->orderBy('screen_name')
                ->limit(30)
                ->get();
        }

        return view('livewire.features.user.search', [
            'users' => $users,
        ]);
    }
}
