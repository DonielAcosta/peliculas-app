<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Series;
use App\Models\Movies;
use App\Models\Users;
use App\Models\Scores;
use Validator;

class ScoresController extends Controller{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
    
        $paginate = request()->get('paginate');
        if ($paginate == null) {
            $paginate = 10;
        }
        $search = request()->get('search');
        $by = 'puntuation'; // Order query by X column
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
        $scores = Scores::with(['Users','Series','Movies'])
        	->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                       $q->where("puntuation", 'ILIKE', "%" . $search . "%")
                       	->orWhere("description", "ILIKE", "%" . $search . "%");
                });
            })
            ->orderBy($by, $dir)
            ->orderBy('id', 'desc')
            ->paginate($paginate);

        return response()->json(
            [
                'listed' => True,
                'data' => $scores,
                'message' => 'Elemento obtenido exitosamente'
            ],
            200
        );
    }

    public function store(Request $request){

        $validator = Validator::make(
            $request->all(),
            [
                'puntuation' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'users_id' => 'required|numeric',
            ]
        );
        if ($validator->fails()) {
            return response()
                ->json(['error' => $validator->errors()], 422);
        }
        $arr = [
            'puntuation' => $request->input('puntuation'),
            'description' => $request->input('description'),
            'users_id' => $request->get('users_id'),
        ];
        $scores = Scores::create($arr);
        return response()->json(
            [
                'created' => true,
                'data' => $scores,
                'message' => 'Elemento creado exitosamente'
            ],
            200
        );
    }

 
    public function show($id){

        $scores = Scores::with(['Users','Series','Movies'])->find($id);
        if (!$scores) {
            return response()->json(['error' => 'Scores_does_not_exist'], 404);
        }

        return response()->json(
            [
                'showed' => True,
                'data' => $scores,
                'message' => 'Elemento obtenido exitosamente'
            ],
            200
        );
    }

    public function update(Request $request, $id){

        $validator = Validator::make(
            $request->all(),
            [
               'puntuation' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'users_id' => 'required|numeric',
            ]
        );
        if ($validator->fails()) {
            return response()
                ->json(['error' => $validator->errors()], 422);
        }
        $scores = Scores::findOrFail($id);
        $scores->fill($request->all());
        $scores->save();
        return response()->json(
            [
                'updated' => True,
                'data' => $scores,
                'message' => 'Elemento obtenido exitosamente'
            ],
            200
        );

    }

    public function destroy($id){
        
        $scores = Scores::findorFail($id);
        $scores->delete();
        return response()->json([
            'deleted' => True,
            'message' => 'Elemento eliminado exitosamente',
        ], 200);
    }
}
