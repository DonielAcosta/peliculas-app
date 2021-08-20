<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UsersDatas;
use App\Models\SexUsersDatas;
use Validator;

class SexUsersDatasController extends Controller{

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
        $sex_users_datas = SexUsersDatas::with(['UsersDatas'])
        	->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                       $q->where("name", 'ILIKE', "%" . $search . "%");
                });
            })
            ->orderBy($by, $dir)
            ->orderBy('id', 'desc')
            ->paginate($paginate);

        return response()->json(
            [
                'listed' => True,
                'data' => $sex_users_datas,
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

            ]
        );
        if ($validator->fails()) {
            return response()
                ->json(['error' => $validator->errors()], 422);
        }
        $arr = [

            'name' => $request->input('name')
        ];
        $sex_users_datas = SexUsersDatas::create($arr);
        return response()->json(
            [
                'created' => true,
                'data' => $sex_users_datas,
                'message' => 'Elemento creado exitosamente'
            ],
            200
        );
    }


    public function show($id)
    {
        $sex_users_datas = SexUsersDatas::with(['UsersDatas'])->find($id);
        if (!$sex_users_datas) {
            return response()->json(['error' => 'sex_users_datas_does_not_exist'], 404);
        }
        return response()->json(
            [
                'showed' => True,
                'data' => $sex_users_datas,
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
                'name' => 'required|string|max:255',
            ]
        );
        if ($validator->fails()) {
            return response()
                ->json(['error' => $validator->errors()], 422);
        }
        $sex_users_datas = SexUsersDatas::findOrFail($id);
        $sex_users_datas->fill($request->all());
        $sex_users_datas->save();
        return response()->json(
            [
                'updated' => True,
                'data' => $sex_users_datas,
                'message' => 'Elemento obtenido exitosamente'
            ],
            200
        );
    }

    public function destroy($id){

        $sex_users_datas = SexUsersDatas::findorFail($id);
        $sex_users_datas->delete();
        return response()->json([
            'deleted' => True,
            'message' => 'Elemento eliminado exitosamente',
        ], 200);
    }
}
