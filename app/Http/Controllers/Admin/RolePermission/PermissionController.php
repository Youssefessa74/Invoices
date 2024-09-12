<?php

namespace App\Http\Controllers\Admin\RolePermission;

use App\DataTables\PermissionDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index(PermissionDataTable $permissionDataTable){
        return $permissionDataTable->render('admin.users.permissions.index');
    }

    public function create(){
        return view('admin.users.permissions.create');
    }

    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name',
        ]);

        // Create the new permission
        Permission::create(['name' => $request->input('name')]);

        toastr('Permission Created Successfully');
        return redirect()->route('permission.index');
    }

    // Destroy a permission
    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        // Check if permission exists
        if ($permission) {
            // Delete the permission
            $permission->delete();

            toastr('Permission Deleted Successfully');
        } else {
            toastr('Permission Not Found');
        }

        return redirect()->route('permission.index');
    }
}
