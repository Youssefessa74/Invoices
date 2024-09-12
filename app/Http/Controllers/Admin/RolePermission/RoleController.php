<?php

namespace App\Http\Controllers\Admin\RolePermission;

use App\DataTables\RoleDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        // Fetch all roles with their associated permissions
        $roles = Role::with('permissions')->get();

        // Pass the roles to the view
        return view('admin.users.roles.index', ['roles' => $roles]);
    }
    public function create()
    {
        $permissions = Permission::all();
        return view('admin.users.roles.create', compact('permissions'));
    }

    public function edit($roleId)
    {
        // Fetch the role to edit
        $role = Role::findOrFail($roleId);

        // Fetch all permissions
        $permissions = Permission::all();

        // Return the edit view with role and permissions data
        return view('admin.users.roles.edit', [
            'role' => $role,
            'permissions' => $permissions
        ]);
    }
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'permissions' => 'array'
        ]);

        // Create the new role
        $role = Role::create(['name' => $request->input('name')]);

        // Sync permissions
        $permissions = $request->input('permissions', []);
        $permissions = array_map('intval', $permissions); // Ensure all IDs are integers
        $role->syncPermissions($permissions);

        toastr('Role Created Successfully');
        return redirect()->route('role.index');
    }
    public function show(Role $role)
    {
        $permissions = Permission::all();
        return view('roles.show', compact('role', 'permissions'));
    }
    public function update(Request $request, $roleId)
    {
        // Validate input
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $roleId,
            'permissions' => 'array'
        ]);

        // Find the role
        $role = Role::findOrFail($roleId);

        // Update role name
        $role->name = $request->input('name');
        $role->save();

        // Sync permissions
        $permissions = $request->input('permissions', []);
        $permissions = array_map('intval', $permissions); // Ensure all IDs are integers
        $role->syncPermissions($permissions);

        toastr('Data Saved Successfully');
        return redirect()->route('role.index');
    }



    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }
}
