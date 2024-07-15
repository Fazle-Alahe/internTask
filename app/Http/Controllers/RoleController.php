<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    function role_manage(){
        $permissions = Permission::all();
        $roles = Role::all();
        $users = User::all();
        return view('dashboard.role_manage',[
            'permissions' => $permissions,
            'roles' => $roles,
            'users' => $users,
        ]);
    }

    function add_permission(Request $request){
        Permission::create(['name' => $request->permission_name]);
        return back();
    }

    function role_store(Request $request){
        $role = Role::create(['name' => $request->role_name]);
        $role->givePermissionTo($request->permission);
        return back();
    }

    function delete_role($id){
        DB::table('role_has_permissions')->where('role_id', $id)->delete();
        Role::find($id)->delete();
        return back()->with('delete', 'Role has deleted');
    }

    function assign_role(Request $request){
        $user = User::find($request->user_id);
        $user->assignRole($request->role);
        return back();
    }

    function remove_role($id){
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        return back()->with('role_remove', 'Role has removed');
    }
}
