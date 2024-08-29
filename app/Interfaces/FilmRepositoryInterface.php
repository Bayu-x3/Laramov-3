<?php
 namespace App\Interfaces;

interface FilmRepositoryInterface
{
    //
    public function index();
    public function getById($id);
    public function store(array $data);
}
// namespace App\Repositories;

// use App\Interfaces\FilmRepositoryInterface;
// use App\Models\Film;

// class FilmRepository implements FilmRepositoryInterface
// {
//     public function index()
//     {
//         return Film::with(['perans', 'kritiks'])->get();
//     }

//     public function getById($id)
//     {
//         return Film::with(['perans', 'kritiks'])->findOrFail($id);
//     }

//     public function store(array $data)
//     {
//         return Film::create($data);
//     }
// }
