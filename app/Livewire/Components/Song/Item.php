<?php

namespace App\Livewire\Components\Song;

use App\Models\Activity;
use App\Models\Song;
use App\Models\Status;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
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
        $validated = Validator::make(
            ['state' => $state],
            ['state' => ['required', 'integer', 'in:0,1,2,3']]
        )->validate();

        $state = (int) $validated['state'];

        [$newState, $changed] = DB::transaction(function () use ($state): array {
            $userId = Auth::id();

            if (! $userId) {
                return [$this->state, false];
            }

            $user = User::whereKey($userId)->lockForUpdate()->first();

            if (! $user) {
                return [$this->state, false];
            }

            $conditions = [
                'user_id' => $userId,
                'song_id' => $this->song->id,
            ];

            $currentStatus = Status::where($conditions)->lockForUpdate()->first();
            $oldState = $currentStatus?->state ?? 0;

            if ($oldState === $state) {
                return [$oldState, false];
            }

            if ($state === 0) {
                $currentStatus?->delete();
            } else {
                Status::updateOrCreate(
                    $conditions,
                    ['state' => $state]
                );
            }

            Activity::create([
                'user_id' => $userId,
                'song_id' => $this->song->id,
                'old_state' => $oldState,
                'new_state' => $state,
            ]);

            $user->activity_count++;

            if ($oldState > 0 ) {
                $user->{"status{$oldState}_count"}--;
            }

            if ($state > 0 ) {
                $user->{"status{$state}_count"}++;
            }

            $user->save();

            return [$state, true];
        });

        $this->state = $newState;

        if ($changed) {
            $this->dispatch('status-updated');
        }
    }

    public function render()
    {
        return view('livewire.components.song.item');
    }
}
