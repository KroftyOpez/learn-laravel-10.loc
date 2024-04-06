<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    //Метод для отображения всего
    public function index() {
        $roles = Role::all();
        if ($roles){
            return response()->json($roles)->setStatusCode(200);
        }else{
            throw new ApiException(404, 'Не найдено!');
        }
    }
    //Метод для отображения текущего
    public function show($id){
        $role = Role::find($id);
        if ($role){
            return response()->json($role)->setStatusCode(200);
        }else{
            throw new ApiException(404, 'Не найдено!');
        }

    }
    //Метод создания
    public function store(CreateRoleRequest $request){
        $role = new Role($request->all());
        $role->save();
        return response()->json($role)->setStatusCode(201);
    }
    //Метод частичного обновления
    public function update(UpdateRoleRequest $request, $id){
        $role = Role::find($id);
        if($role){
            $role->update($request->all());
            return response()->json($role)->setStatusCode(200);
        }else{
            throw new ApiException(404, 'Не найдено!');
        }
    }
    //Метод удаления
    public function destroy($id) {
        $role = Role::find($id);
        if ($role) {
            Role::destroy($id);
            return response()->json()->setStatusCode(204);
        }else{
            throw new ApiException(404, 'Не найдено!');
        }
    }
}
