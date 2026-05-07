<?php

namespace App\Livewire\Song;

use App\Models\Status;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class StateSelector extends Component
{
    public int $songId;
    public int $state = 0;

    public function mount(int $songId, int $state = 0): void
    {
        $this->songId = $songId;
        $this->state = $state;
    }

    public function updateState(int $state): void
    {
        $conditions = [
            'user_id' => Auth::id(),
            'song_id' => $this->songId,
        ];

        if ($state === 0) {
            Status::where($conditions)->delete();
        } else {
            Status::updateOrCreate(
                $conditions,
                ['state' => $state]
            );
        }

        $this->state = $state;
    }

    public function render()
    {
        return view('livewire.song.state-selector');
    }
}