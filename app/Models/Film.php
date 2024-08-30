<?php

namespace App\Models;

use App\Models\Genre;
use App\Models\Peran;
use App\Models\Kritik;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Film extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'sinopsis', 'year', 'poster', 'genre_id'];

    public function kritiks()
    {
        return $this->hasMany(Kritik::class, 'film_id');
    }

    public function perans()
    {
        return $this->hasMany(Peran::class, 'film_id');
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class, 'genre_id');
    }
}
