<?php

namespace App\Http\Controllers\Admin\RolePermission;

use App\DataTables\UserDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(UserDataTable $userDataTable)
    {

        return $userDataTable->render('admin.users.index');
    }

    public function create(){
        $role_names = Role::all();
     return view('admin.users.create',compact('role_names'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'role_name' => 'array',
            'role_name.*' => 'exists:roles,id',
            'role' => 'required|string|in:user,admin',
            'status' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create the user
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => $request->input('role'),
            'status' => $request->input('status'),
        ]);

        // Convert role IDs to role objects
        $roleIds = $request->input('role_name', []);
        $roles = Role::whereIn('id', $roleIds)->pluck('name');

        // Sync roles
        $user->syncRoles($roles);

        toastr('User Created Successfully');
        return redirect()->route('user.index'); // Adjust this as needed
    }


    public function show(User $user)
    {
        $roles = Role::all();
        return view('users.show', compact('user', 'roles'));
    }

    public function assignRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|exists:roles,name',
        ]);

        $user->assignRole($request->role);
        return redirect()->back()->with('success', 'Role assigned successfully.');
    }

    public function revokeRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|exists:roles,name',
        ]);

        $user->removeRole($request->role);
        return redirect()->back()->with('success', 'Role removed successfully.');
    }

    public function destroy($id){
        $user = User::findOrFail($id);
        $user->delete();
        toastr('User Created Successfully');
        return redirect()->route('user.index'); // Adjust this as needed

    }
}
