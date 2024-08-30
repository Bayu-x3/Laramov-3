<?php

namespace App\Models;

use App\Models\Cast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Peran extends \Illuminate\Database\Eloquent\Model
{
    use HasFactory;
    protected $table = 'perans';
    protected $fillable = ['actor', 'film_id', 'cast_id'];


public function cast()
{
    return $this->belongsTo(Cast::class, 'cast_id');
}

}