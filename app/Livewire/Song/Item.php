<?php

namespace App\Livewire\Song;

use App\Models\Activity;
use App\Models\Song;
use App\Models\Status;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Item extends Component
{
    public Song $song;
    public int $state = 0;

    public function mount(Song $song, int $state = 0): void
    {
        $this->song = $song;
        $this->state = $state;
    }

    public function updateState($state): void
    {
        DB::transaction(function () use ($state): void {
            $conditions = [
                'user_id' => Auth::id(),
                'song_id' => $this->song->id,
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
                'song_id' => $this->song->id,
                'old_state' => $this->state,
                'new_state' => $state,
            ]);
        });

        $this->state = $state;
        $this->dispatch('status-updated');
    }

    public function render()
    {
        return view('livewire.song.item');
    }
}
