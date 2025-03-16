<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ManagePermissionController extends Controller
{


    /**
     * returns view for permissions management
     *
     */
    public function managePermissions(Request $request){
        $permissions = Permission::with('roles')->get();
        $roles = Role::with('permissions')->get();
        return view('admin.manage_permissions', compact('roles','permissions'));
    }

    /**
     * Assinging permissions based on roles
    */
    public function assignPermissions(Request $request){
        foreach ($request->permissions as $roleId => $permissions) {
            $role = Role::find($roleId);
            if ($role) {
                $role->syncPermissions($permissions);
            }
        }
        return redirect()->route('manage.permissions.index')
            ->with('success', 'Permissions updated successfully.');
    }



}
