<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seasons;
use App\Models\Series;
use Validator;

class SeasonsController extends Controller{

    public function index(Request $request){
        
        $paginate = request()->get('paginate');
        if ($paginate == null) {
            $paginate = 10;
        }
        $search = request()->get('search');
        $by = 'seasons_number'; // Order query by X column
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
        $seasons = Seasons::with(['Series'])
        	->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                       $q->where("seasons_number", 'ILIKE', "%" . $search . "%")
                       ->orWhere("cap", "ILIKE", "%" . $search . "%");;
                });
            })
            ->orderBy($by, $dir)
            ->orderBy('id', 'desc')
            ->paginate($paginate);

        return response()->json(
            [
                'listed' => True,
                'data' => $seasons,
                'message' => 'Elemento obtenido exitosamente'
            ],
            200
        );
    }

    public function store(Request $request){

        $validator = Validator::make(
            $request->all(),
            [
                'cap' => 'required|string|max:255',
                'seasons_number' => 'required|string|max:255',
            ]
        );
        if ($validator->fails()) {
            return response()
                ->json(['error' => $validator->errors()], 422);
        }
        $arr = [

            'cap' => $request->input('cap'),
            'seasons_number' => $request->input('seasons_number'),

        ];
        $seasons = Seasons::create($arr);
        return response()->json(
            [
                'created' => true,
                'data' => $seasons,
                'message' => 'Elemento creado exitosamente'
            ],
            200
        );
    }


    public function show($id)
    {
        $seasons = Seasons::with(['Series'])->find($id);
        if (!$seasons) {
            return response()->json(['error' => 'seasons_does_not_exist'], 404);
        }
        return response()->json(
            [
                'showed' => True,
                'data' => $seasons,
                'message' => 'Elemento obtenido exitosamente'
            ],
            200
        );
    }


    public function update(Request $request, $id)
    { 
        $validator = Validator::make(
            $request->all(),
            [
                'cap' => 'required|string|max:255',
                'seasons_number' => 'required|string|max:255',
            ]
        );
        if ($validator->fails()) {
            return response()
                ->json(['error' => $validator->errors()], 422);
        }
        $seasons = Seasons::findOrFail($id);
        $seasons->fill($request->all());
        $seasons->save();
        return response()->json(
            [
                'updated' => True,
                'data' => $seasons,
                'message' => 'Elemento obtenido exitosamente'
            ],
            200
        );
    }

    public function destroy($id){

        $seasons = Seasons::findorFail($id);
        $seasons->delete();
        return response()->json([
            'deleted' => True,
            'message' => 'Elemento eliminado exitosamente',
        ], 200);
    }
}
