<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\SexUsersDatas;
use App\Models\UsersDatas;
use Validator;

class UsersDatasController extends Controller{
  

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
        $users_datas = UsersDatas::with(['Users','SexUsersDatas'])
        	->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                       $q->where("name", 'ILIKE', "%" . $search . "%")
                       	->orWhere("lastname", "ILIKE", "%" . $search . "%")
                       	->orWhere("date_of_birth", "ILIKE", "%" . $search . "%")
                       	->orWhere("phone", "ILIKE", "%" . $search . "%");
                });
            })
            ->orderBy($by, $dir)
            ->orderBy('id', 'desc')
            ->paginate($paginate);

        return response()->json(
            [
                'listed' => True,
                'data' => $users_datas,
                'message' => 'Elemento obtenido exitosamente'
            ],
            200
        );
    }

   

    public function store(Request $request){

        $validator = Validator::make(
            $request->all(),
            [
                'sex_users_datas_id' => 'required|numeric',
                'users_id' => 'required|numeric',
                'name' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'date_of_birth' => 'required|date',
                'phone' => 'required|string|max:15'
            ]
        );
        if ($validator->fails()) {
            return response()
                ->json(['error' => $validator->errors()], 422);
        }
        $arr = [
            'sex_users_datas_id' => $request->get('sex_users_datas_id'),
            'users_id' => $request->get('users_id'),
            'name' => $request->input('name'),
            'lastname' => $request->input('lastname'),
            'date_of_birth' => $request->input('date_of_birth'),
            'phone' => $request->input('phone'),

        ];
        $users_datas = UsersDatas::create($arr);
        return response()->json(
            [
                'created' => true,
                'data' => $users_datas,
                'message' => 'Elemento creado exitosamente'
            ],
            200
        );
    }


    public function show($id)
    {
        $users_datas = UsersDatas::with(['Users','SexUsersDatas'])->find($id);
        if (!$users_datas) {
            return response()->json(['error' => 'users_datas_does_not_exist'], 404);
        }
        return response()->json(
            [
                'showed' => True,
                'data' => $users_datas,
                'message' => 'Elemento obtenido exitosamente'
            ],
            200
        );
    }
    
  
    public function update(Request $request, $id){

        $validator = Validator::make(
            $request->all(),
            [
                'sex_users_datas_id' => 'required|numeric',
                'users_id' => 'required|numeric',
                'name' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'date_of_birth' => 'required|date',
                'phone' => 'required|string|max:15',
            ]
        );
        if ($validator->fails()) {
            return response()
                ->json(['error' => $validator->errors()], 422);
        }
        $users_datas = UsersDatas::findOrFail($id);
        $users_datas->fill($request->all());
        $users_datas->save();
        return response()->json(
            [
                'updated' => True,
                'data' => $users_datas,
                'message' => 'Elemento obtenido exitosamente'
            ],
            200
        );
    }

 
    public function destroy($id){

        $users_datas = UsersDatas::findorFail($id);
        $users_datas->delete();
        return response()->json([
            'deleted' => True,
            'message' => 'Elemento eliminado exitosamente',
        ], 200);
    }
}
