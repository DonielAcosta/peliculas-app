<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Series;
use App\Models\Movies;
use App\Models\Directores;
use Validator;

class DirectoresController extends Controller{
   
    public function index(Request $request){

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
        $directores = Directores::with(['Series','Movies'])
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                        $q->where("name", 'ILIKE', "%" . $search . "%")
                        ->orWhere("lastname", "ILIKE", "%" . $search . "%")
                        ->orWhere("description", "ILIKE", "%" . $search . "%");
                });
            })
            ->orderBy($by, $dir)
            ->orderBy('id', 'desc')
            ->paginate($paginate);

        return response()->json(
            [
                'listed' => True,
                'data' => $directores,
                'message' => 'Elemento obtenido exitosamente'
            ],
            200
        );
    }

    public function store(Request $request){

        $validator = Validator::make(
            $request->all(),
            [   
                'name' => 'required|string',
                'lastname' => 'required|string',
                'description' => 'required|string',
            ]
        );
        if ($validator->fails()) {
            return response()
                ->json(['error' => $validator->errors()], 422);
        }
        $arr = [
            'name' => $request->input('name'),
            'lastname' => $request->input('lastname'),
            'description' => $request->input('description'),
       
        ];
        $directores = Directores::create($arr);
        return response()->json(
            [
                'created' => true,
                'data' => $directores,
                'message' => 'Elemento creado exitosamente'
            ],
            200
        );
        
    }


    public function show($id){
        
        $directores = Directores::with(['Series','Movies'])->find($id);
        if (!$directores) {
            return response()->json(['error' => 'Directores_does_not_exist'], 404);
        }
        return response()->json(
            [
                'showed' => True,
                'data' => $directores,
                'message' => 'Elemento obtenido exitosamente'
            ],
            200
        );
    }

    public function update(Request $request, $id){

        $validator = Validator::make(
            $request->all(),
            [
               'name' => 'required|string',
                'lastname' => 'required|string',
                'description' => 'required|string',
            ]
        );
        if ($validator->fails()) {
            return response()
                ->json(['error' => $validator->errors()], 422);
        }
        $directores = Directores::findOrFail($id);
        $directores->fill($request->all());
        $directores->save();
        return response()->json(
            [
                'updated' => True,
                'data' => $directores,
                'message' => 'Elemento obtenido exitosamente'
            ],
            200
        );
        
    }

    public function destroy($id){

        $directores = Directores::findorFail($id);
        $directores->delete();
        return response()->json([
            'deleted' => True,
            'message' => 'Elemento eliminado exitosamente',
        ], 200);
    
    }
}
