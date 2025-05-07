<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'tracks';

    protected $fillable = [
        'name',
        'album_id',
        'media_type_id',
        'genre_id',
        'composer',
        'milliseconds',
        'bytes',
        'unit_price',
    ];

    public function album()
    {
        return $this->belongsTo(Album::class);
    }

    public function mediaType()
    {
        return $this->belongsTo(MediaType::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function invoiceItems()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function playlists()
    {
        return $this->belongsToMany(Playlist::class, 'playlist_track');
    }
}
