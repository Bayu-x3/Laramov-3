<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Classes\ApiResponseClass;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\FilmResource;
use App\Repositories\FilmRepository;
use Dotenv\Repository\RepositoryInterface;
use App\Interfaces\FilmRepositoryInterface; // Fixed typo
use App\Http\Requests\Api\StoreFilmRequest; // Fixed typo in namespace

class FilmController extends Controller
{
    private FilmRepository $filmRepositoryInterface;

    public function __construct(FilmRepository $filmRepositoryInterface)
    {
        $this->filmRepositoryInterface = $filmRepositoryInterface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
        $data = [
            'title' => $request->title,
            'sinopsis' => $request->sinopsis, // Fixed missing comma
            'year' => $request->year,
            'poster' => 'storage/images/h11.jpg',
            'genre_id' => $request->genre_id,
        ];

        DB::beginTransaction();
        try {
            $film = $this->filmRepositoryInterface->store($data); // Fixed variable name and array key

            DB::commit();
            return ApiResponseClass::sendResponse(new FilmResource($film), 'Film Create Successful', 201); // Changed ProductResource to FilmResource

        } catch (\Exception $ex) {
            DB::rollBack(); // Added DB rollback
            return ApiResponseClass::rollback($ex); // Assuming you have a method for this
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
}
