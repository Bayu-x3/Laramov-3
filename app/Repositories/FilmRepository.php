<?php

namespace App\Repositories;
use App\Models\Film;
use App\Interfaces\FilmRepositoryInterfaces;

class FilmRepository implements FilmRepositoryInterfaces
{
    /**
     * Create a new class instance.
     */

    public function index()
    {
        return Film::all();
    }
 
     public function store(array $data){
        return Film::create($data);
     }

     public function getById($id){
        return Film::findOrFail($id);
     }

}