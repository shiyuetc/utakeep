<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = [
        'user_id',
        'song_id',
        'state',
    ];

    public function song()
    {
        return $this->belongsTo(Song::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
