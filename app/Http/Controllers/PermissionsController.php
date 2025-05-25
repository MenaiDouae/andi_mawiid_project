<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Permission;
class PermissionsController extends Controller
{
    public function index(){
        $permissions = Permission::with('sub_permissions')->whereNull('sub_permission')->get();
        return response()->json($permissions);
    }

    public function edit($id_permission)
    {
        $permission = Permission::with('sub_permissions')->find($id_permission);
        if(!$permission)
            return response()->json([
                'message' => 'Permission not found!'
            ], 404);

        return response()->json($permission);
    }
}
