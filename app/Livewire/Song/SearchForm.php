<?php

namespace App\Livewire\Song;

use App\Models\Song;
use App\Models\Status;
use App\Services\ItunesSearchService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SearchForm extends Component
{
    public string $term = '';
    public array $songs = [];
    public array $statuses = [];
    public bool $searched = false;

    public function search(ItunesSearchService $service): void
    {
        $this->validate(['term' => 'required|string|min:1']);

        $results = $service->searchSongs($this->term);

        foreach ($results as $item) {
            Song::updateOrInsert(
                ['id' => $item['trackId']],
                [
                    'title'       => $item['trackCensoredName'],
                    'artist_id'   => $item['artistId'],
                    'artist_name' => $item['artistName'],
                    'image_url' => $item['artworkUrl60'] ?? null,
                    'audio_url' => $item['previewUrl'] ?? null,
                ]
            );
        }

        $this->songs = Song::where('title', 'like', "%{$this->term}%")
            ->orWhere('artist_name', 'like', "%{$this->term}%")
            ->get()
            ->toArray();

        $songIds = array_column($this->songs, 'id');
        $this->statuses = Status::where('user_id', Auth::id())
            ->whereIn('song_id', $songIds)
            ->pluck('state', 'song_id')
            ->toArray();

        $this->searched = true;
    }

    public function render()
    {
        return view('livewire.song.search-form');
    }
}