<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    public $incrementing = false;

    protected $keyType = 'integer';

    protected $fillable = [
        'id',
        'title',
        'artist_id',
        'artist_name',
        'image_url',
        'audio_url',
    ];
}
