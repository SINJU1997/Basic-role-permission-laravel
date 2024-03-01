<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class EmployeeController extends Controller
{
    public static function create(){
        return view('registration');
    }
    public static function store(Request $request){
        $formData=$request->validate([
            'name'=>'required',
            'place'=>'required',
            'designation'=>'required'
        ]);
        Employee::create($formData);
        return redirect('/');
    }
    public static function index(){
        $data=[
            'employees'=>Employee::all()
        ];
        return view('display',$data);
    }
    public static function createPermission(){

        // find role and permission of particular id
        $role=Role::findById(1);
        $permission=Permission::findById(1);

        // create role and permission
        // $role = Role::create(['name' => 'admin']);
        // $permission = Permission::create(['name' => 'view employees']);

        // assign permission to a particular role
        $role->givePermissionTo($permission);
        $permission->assignRole($role);

        // give permission
        $user = User::find(1);
        $user->assignRole($role);
    }
}
