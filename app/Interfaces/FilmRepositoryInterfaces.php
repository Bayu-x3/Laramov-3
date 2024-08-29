<?php

namespace App\Interfaces;

interface FilmRepositoryInterfaces
{
    //
    public function index();
    public function getById($id);
    public function store(array $data);
}