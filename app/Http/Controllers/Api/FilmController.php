<?php

    namespace App\Http\Controllers\Api;

    use App\Http\Controllers\Controller;
    use illuminate\Http\Request;
    use App\Http\Requests\Api\StoreFilmRequest;
    
    use App\Interfaces\FilmRepositoryInterface;
    use App\Classes\ApiResponseClass;
    use App\Http\Resources\FilmResource;
    use Illuminate\Support\Facades\DB;

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
        $data = $this->filmRepositoryInterface->index();
        return ApiResponseClass::sendResponse(FilmResource::collection($data),'', 200);
        //
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
        //
        $posterPath = $request->file('poster')->store('images');

        $data = [
            'title'     => $request->title,
            'sinopsis'  => $request->sinopsis,
            'year'      => $request->year,
            'poster'    => $posterPath,
            'genre_id'  => $request->genre_id,
        ];

        DB::beginTransaction();
        try{
             $film = $this->filmRepositoryInterface->store($data);

             DB::commit();
             return ApiResponseClass::sendResponse(new FilmResource($film),'Film Create Successful',201);

        }catch(\Exception $ex){
            return ApiResponseClass::rollback($ex);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
      
        {
            $Film = $this->filmRepositoryInterface->getById($id);
    
            $Film['kritiks'] = $Film->kritik()->get();
            $Film['perans'] = $Film->peran()->get();
            return ApiResponseClass::sendResponse(new FilmResource($Film),'',200);
        }
        
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
    public function destroy(string $id)
    {
        //
    }
}