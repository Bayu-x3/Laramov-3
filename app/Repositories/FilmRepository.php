<?php

namespace App\Repositories;

use App\Models\Film;
use App\Interfaces\FilmRepoistoryInterface;

class FilmRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function index()
    {
        return Film::all();
    }

    public function store(array $data){
    return Film::create($data);
    }

}