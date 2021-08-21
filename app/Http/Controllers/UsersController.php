<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Users;
use App\Models\UsersDatas;
use Validator;

class UsersController extends Controller{

    public function index(){
        $paginate = request()->get('paginate');
        if ($paginate == null) {
            $paginate = 10;
        }
        $search = request()->get('search');
        $by = 'email'; // Order query by X column
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
        
        $users = Users::with(['UsersDatas','Favorites','Scores'])
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where("email", 'ILIKE', "%" . $search . "%");

                });
        })
         ->orderBy($by, $dir)
         ->orderBy('id', 'desc')
         ->paginate($paginate);

        return response()->json(
            [
                'listed' => True,
                'data' => $users,
                'message' => 'Elemento obtenido exitosamente'
            ],
            200
        );
    }


    public function store(Request $request){

        $form = json_decode($request->input('form'));
        $file = $request->file('file');
        $path = Storage::disk('public')->put('profile', $file);

        

        $arr = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            // 'date' => $request->input('date')
        ];
        $users = Users::create($arr);
        // [
        //     'email' => $form->email,
        //     'password' => Hash::make($form->password)
        // ]);

        // $usersDatas = UsersDatas::create([
        //     'users_id' => $user->id,
        //     'sex_users_datas_id' => $form->sex_users_datas_id,
        //     'name' => $form->name,
        //     'lastname' => $form->lastname,
        //     'date_of_birth' => $date,
        //     'phone' => $form->phone,
        // ]);
        return response()->json(['data' => 
            [
                'user' => $users,
                // 'userData' => $usersDatas,
            ],
            'message' => 'Usuario creado exitosamente'
        ], 201);
    }

   
    public function show($id){

        $users = Users::with(['UsersDatas', 'Scores','Favorites'])->find($id);
        if (!$users) {
            return response()->json(['error' => 'users_does_not_exist'], 404);
        }
        return response()->json(
            [
                'showed' => True,
                'data' => $users,
                'message' => 'Elemento obtenido exitosamente'
            ],
            200
        );
    }

 
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'sex_users_datas_id' => 'numeric|required ',
                'lastname' => 'required|string|max:30',
                'date_of_birth' => 'required|date',
                'phone' => 'required|string|max:15',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        $users = Users::findOrFail($id);
        $users_datas = UsersDatas::where('users_id', $id)->first();
        $users->fill([
            'email' => $request->input('email'),
        ]);
        $users_datas->fill([
            'sex_users_data_id' => $request->input('sex_users_datas_id'),
            'name' => $request->input('name'),
            'lastname' => $request->input('lastname'),
            'date_of_birth' => $request->input('date_of_birth'),
            'phone' => $request->input('phone'),
        ]);
        $users->save();
        $users_datas->save();
        return response()->json(
            [
                'updated' => True,
                'data' => [
                    'users' => $users,
                    'usersDatas' => $users_datas,
                ],
                'message' => 'Elemento actualizado exitosamente'
            ],
            200
        );
    }

    public function destroy($id)
    {
        $users = Users::findorFail($id);
        $users->delete();
        return response()->json([
            'deleted' => True,
            'message' => 'Elemento eliminado exitosamente',
        ], 200);
    }
}
