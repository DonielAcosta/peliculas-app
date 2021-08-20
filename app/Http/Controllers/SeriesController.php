<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Directores;
use App\Models\Series;
use App\Models\Seasons;
use App\Models\Scores;
use Validator;

class SeriesController extends Controller{
 
    public function index()
    {
    
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
        $series = Series::with(['Scores','Seasons','Directores'])
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
                'data' => $series,
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
                'seasons_id' => 'required|numeric',
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
            'seasons_id' => $request->get('seasons_id'),
        ];
        $series = Series::create($arr);
        return response()->json(
            [
                'created' => true,
                'data' => $series,
                'message' => 'Elemento creado exitosamente'
            ],
            200
        );
    }

 
    public function show($id){

        $series = Series::with(['Scores','Seasons','Directores'])->find($id);
        if (!$series) {
            return response()->json(['error' => 'series_does_not_exist'], 404);
        }

        return response()->json(
            [
                'showed' => True,
                'data' => $series,
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
                'seasons_id' => 'required|numeric',
            ]
        );
        if ($validator->fails()) {
            return response()
                ->json(['error' => $validator->errors()], 422);
        }
        $series = Series::findOrFail($id);
        $series->fill($request->all());
        $series->save();
        return response()->json(
            [
                'updated' => True,
                'data' => $series,
                'message' => 'Elemento obtenido exitosamente'
            ],
            200
        );

    }


    public function destroy($id)
    {
        $series = Series::findorFail($id);
        $series->delete();
        return response()->json([
            'deleted' => True,
            'message' => 'Elemento eliminado exitosamente',
        ], 200);
    }
}
