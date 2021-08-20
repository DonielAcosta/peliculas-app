<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Directores;
use App\Models\Series;
use App\Models\Scores;
use App\Models\Movies;
use Validator;

class MoviesController extends Controller{

   
    public function index(){
    
        $paginate = request()->get('paginate');
        if ($paginate == null) {
            $paginate = 10;
        }
        $search = request()->get('search');
        $by = 'name'; // Order query by X column
        if (request()->has('orderBy')) {
            $by = request()->get('orderBy');
        }
        $dir = 'desc'; // Direction of the Order by
        if (request()->has('dirDesc')) {
            if (request()->get('dirDesc') === 'true') {
                $dir = 'desc';
            } else {
                $dir = 'asc';
            }
        }
        $movies = Movies::with(['Scores','Directores','Favorites'])
        	->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                       $q->where("name", 'ILIKE', "%" . $search . "%")
                       	->orWhere("description", "ILIKE", "%" . $search . "%");
                });
            })
            ->orderBy($by, $dir)
            ->orderBy('id', 'desc')
            ->paginate($paginate);

        return response()->json(
            [
                'listed' => True,
                'data' => $movies,
                'message' => 'Elemento obtenido exitosamente'
            ],
            200
        );
    }

    public function store(Request $request){

        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'year' => 'date',
                'scores_id' => 'required|numeric',
                'directores_id' => 'required|numeric',
            ]
        );
        if ($validator->fails()) {
            return response()
                ->json(['error' => $validator->errors()], 422);
        }
        $arr = [
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'year' => $request->input('year'),
            'scores_id' => $request->get('scores_id'),
            'directores_id' => $request->get('directores_id'),
        ];
        $movies = Movies::create($arr);
        return response()->json(
            [
                'created' => true,
                'data' => $movies,
                'message' => 'Elemento creado exitosamente'
            ],
            200
        );
    }

 
    public function show($id){

        $movies = Movies::with(['Scores','Directores','Favorites'])->find($id);
        if (!$movies) {
            return response()->json(['error' => 'movies_does_not_exist'], 404);
        }

        return response()->json(
            [
                'showed' => True,
                'data' => $movies,
                'message' => 'Elemento obtenido exitosamente'
            ],
            200
        );
    }

    public function update(Request $request, $id){

        $validator = Validator::make(
            $request->all(),
            [
               'name' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'year' => 'date',
                'scores_id' => 'required|numeric',
                'directores_id' => 'required|numeric',
            ]
        );
        if ($validator->fails()) {
            return response()
                ->json(['error' => $validator->errors()], 422);
        }
        $movies = Movies::findOrFail($id);
        $movies->fill($request->all());
        $movies->save();
        return response()->json(
            [
                'updated' => True,
                'data' => $movies,
                'message' => 'Elemento obtenido exitosamente'
            ],
            200
        );

    }


    public function destroy($id)
    {
        $movies = Movies::findorFail($id);
        $movies->delete();
        return response()->json([
            'deleted' => True,
            'message' => 'Elemento eliminado exitosamente',
        ], 200);
    }
}
