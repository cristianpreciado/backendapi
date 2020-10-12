<?php

namespace App\Http\Controllers;

Use App\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    public function index()
    {
        return Users::all();
    }

    public function show($id)
    {
        $users = Users::find($id);
        return $users;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Users::rules());
        
        if ($validator->fails()) {
            return response()->json([$validator->messages()->first()], 401);
        }

        $users =  new Users;
        $users->first_name=$request->get('first_name');
        $users->last_name=$request->get('last_name');
        $users->email=$request->get('email');
        $users->password=Hash::make($request->get('password'));
        $users->token=str_random(10);
        $users->age=$request->get('age');
        $users->image = $this->getUrlImage($request->file('image'));
        $users->description=$request->get('description');
        $users->save(); 

        return response()->json($users, 201);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), Users::rules($id));
        
        if ($validator->fails()) {
            return response()->json([$validator->messages()->first()], 401);
        }
        
        $users = Users::find($id);
        $users->first_name=$request->get('first_name');
        $users->last_name=$request->get('last_name');
        $users->email=$request->get('email');
        $users->password=Hash::make($request->get('password'));
        $users->token=str_random(10);
        $users->age=$request->get('age');
        $users->image = $this->getUrlImage($request->file('image'));
        $users->description=$request->get('description');
        $users->save(); 

        return response()->json($users, 200);
    }

    public function updateByData(Request $request, $id)
    {
        $users = Users::find($id);
        $users->first_name=$request->get('first_name')?$request->get('first_name'):$users->first_name;
        $users->last_name=$request->get('last_name')?$request->get('last_name'):$users->last_name;
        $users->email=$request->get('email')?$request->get('email'):$users->email;
        $users->password=$request->get('password')?Hash::make($request->get('password')):$users->password;
        $users->token=str_random(10);
        $users->age=$request->get('age')?$request->get('age'):$users->age;
        $users->image = $request->file('image')?$this->getUrlImage($request->file('image')):$users->image;
        $users->description=$request->get('description')?$request->get('description'):$users->description;
        $users->save(); 

        return response()->json($users, 200);
    }

    public function delete($id)
    {
        $users = Users::find($id);
        $users->delete();

        return response()->json(null, 204);
    }

    private function getUrlImage($image){
        if(!$image){
            return null;
        }
        $uploadFolder = 'users';
        $image_uploaded_path = $image->store($uploadFolder, 'public');
        return Storage::disk('public')->url($image_uploaded_path);
    }
}
