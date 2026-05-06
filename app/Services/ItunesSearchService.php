<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ItunesSearchService
{
    public function searchSongs(string $term, int $page = 1): array
    {
        $response = Http::get('https://itunes.apple.com/search', [
            'term'     => $term,
            'media'    => 'music',
            'entity'   => 'song',
            'country'  => 'JP',
            'lang'     => 'ja_jp',
            'limit'    => 20,
            'offset'   => ($page - 1) * 20,
        ]);

        if ($response->failed()) {
            return [];
        }

        return $response->json('results') ?? [];
    }
}