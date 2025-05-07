<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'artists';

    protected $fillable = [
        'name',
    ];

    public function albums()
    {
        return $this->hasMany(Album::class);
    }
}
