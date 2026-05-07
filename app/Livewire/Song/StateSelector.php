<?php

namespace App\Livewire\Song;

use App\Models\Activity;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        DB::transaction(function () use ($state): void {
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

            Activity::create([
                'user_id' => Auth::id(),
                'song_id' => $this->songId,
                'old_state' => $this->state,
                'new_state' => $state,
            ]);
        });

        $this->state = $state;
    }

    public function render()
    {
        return view('livewire.song.state-selector');
    }
}
