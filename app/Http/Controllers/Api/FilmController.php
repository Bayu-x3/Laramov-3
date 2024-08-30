<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\{
    StoreFilmRequest,
    UpdateFilmRequest,
};
use App\Interfaces\FilmRepositoryInterface;
use App\Classes\ApiResponseClass;
use App\Http\Resources\FilmResource;
use Illuminate\Support\Facades\DB;
use App\Repositories\FilmReposiotry;



class FilmController extends Controller
{
    private FilmRepositoryInterface $filmRepositoryInterface;

    public function __construct(FilmRepositoryInterface $filmRepositoryInterface)
    {
        $this->filmRepositoryInterface = $filmRepositoryInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = $this->filmRepositoryInterface->index();

        return ApiResponseClass::sendResponse(FilmResource::collection($data), '', 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFilmRequest $request)
    {
        $posterPath = $request->file('poster')->store('storage/images');

        $details = [
            'title'     => $request->title,
            'sinopsis'  => $request->sinopsis,
            'poster'    => $posterPath,
            'year'      => $request->year,
            'genre_id'  => $request->genre_id,
        ];

        DB::beginTransaction();
        try{
            $film = $this->filmRepositoryInterface->store($details);
            DB::commit();
            return ApiResponseClass::sendResponse(new FilmResource($film), 'Film Create Successful', 200);
        } catch(\Exeption $ex) {
            return ApiResponseClass::rollback($ex);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
{
    // Mengambil data film berdasarkan ID
    $film = $this->filmRepositoryInterface->getById($id);

    // Mengembalikan respons dalam bentuk JSON
    return ApiResponseClass::sendResponse(new FilmResource($film), '', 200);
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFilmRequest $request, $id)
    {
        $posterPath = $request->file('poster')->store('images');
        $updateDetails = [
            'title'     => $request->title,
            'sinopsis'  => $request->sinopsis,
            'poster'    => $request->$posterPath,
            'year'      => $request->year,
            'genre_id'  => $request->genre_id,
        ];

        DB::beginTransaction();
        try{
            $film = $this->filmRepositoryInterface->update($updateDetails, $id);
            DB::commit();
            return ApiResponseClass::sendResponse('Film Update Successful', 200);
        } catch(\Exeption $ex) {
            return ApiResponseClass::rollback($ex);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $this->filmRepositoryInterface->delete($id);
        return ApiResponseClass::sendResponse('Film Delete Successful', 204);
    }
}