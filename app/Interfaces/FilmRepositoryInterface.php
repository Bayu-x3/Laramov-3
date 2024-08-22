<?php

namespace App\Interfaces;

use App\Models\Film;

interface ProductRepositoryInterface
{
    public function index();
    public function store(array $data);
}