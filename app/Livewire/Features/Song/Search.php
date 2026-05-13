<?php

namespace App\Livewire\Features\Song;

use App\Models\Song;
use App\Models\Status;
use App\Services\ItunesSearchService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Search extends Component
{
    public string $term = '';
    public $songs = [];
    public array $statuses = [];
    public bool $searched = false;

    public function mount(): void
    {
        $this->term = trim((string) request()->query('q', ''));

        if ($this->term !== '') {
            $this->searchSongs(app(ItunesSearchService::class));
        }
    }

    public function search(ItunesSearchService $service): void
    {
        $this->validate(['term' => 'required|string|min:1']);
        $this->searchSongs($service);
    }

    private function searchSongs(ItunesSearchService $service): void
    {
        $artistId = preg_match('/^artist_id:(\d+)$/', trim($this->term), $matches)
            ? $matches[1]
            : null;

        $results = $artistId === null
            ? $service->searchSongs($this->term)
            : $service->searchSongFromArtist($artistId);

        foreach ($results as $item) {
            if (! isset($item['trackId'])) {
                continue;
            }

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

        $this->songs = $artistId === null
            ? Song::where('title', 'like', "%{$this->term}%")
                ->orWhere('artist_name', 'like', "%{$this->term}%")
                ->get()
            : Song::where('artist_id', $artistId)->get();

        $songIds = $this->songs->pluck('id')->all();
        $this->statuses = Status::where('user_id', Auth::id())
            ->whereIn('song_id', $songIds)
            ->pluck('state', 'song_id')
            ->toArray();

        $this->searched = true;
    }

    public function render()
    {
        return view('livewire.features.song.search');
    }
}
