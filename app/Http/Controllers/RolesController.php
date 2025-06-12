<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
        public function index()
    {
        $roles = Role::with('permissions')->get();
        return response()->json($roles);
    }

    public function store(Request $request)
    {
        $role = Role::where('name', $request->name)->first();
        if($role)
        {
            return response()->json([
                "type_message" => "danger",
                "message" => "The Role entered already exists!"
            ], 400);
        }else{
            $role = Role::create([
                'name' => $request->name,
            ]);
            if($request->has('permissions')){
                foreach($request->permissions as $id_permission){
                    $role->givePermissionTo(Permission::findById($id_permission));
                }
            }
            return response()->json([
                "type_message" => "success",
                "message" => "Role Created Successfully!"
            ], 201);
        }
    }

    public function edit($id_role)
    {
        $role = Role::with('permissions')->find($id_role);
        if(!$role)
            return response()->json([
                "type_message" => "danger",
                "message" => "Role Not Found!"
            ], 404);
        return response()->json($role);
    }

    public function update(Request $request, $id_role)
    {
        $role = Role::find($id_role);
        if(!$role)
            return response()->json([
                "type_message" => "danger",
                "message" => "Role Not Found!"
            ], 404);

        DB::table('role_has_permissions')->where('role_id', $id_role)->delete();

        $role->update([
            'name' => $request->name,
        ]);

        if (is_array($request->permissions)){
        foreach($request->permissions as $id_permission){
            $role->givePermissionTo(Permission::findById($id_permission));
        }
    }
        return response()->json([
            "type_message" => "success",
            "message" => "Role Updated Successfully!"
        ], 201);
    }

    public function destroy($id_role)
    {
        $role = Role::find($id_role);
        $role->delete();
        return response()->json([
            "type_message" => "success",
            "message" => "Role Deleted Successfully!"
        ]);
    }
}
