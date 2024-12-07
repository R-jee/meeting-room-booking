<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionController extends Controller
{
    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function index()
    {
        $users = User::all();
        $roles = Role::all();
        $permissions = Permission::all();

        return view('admin.assign-roles', compact('users', 'roles', 'permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'roles' => 'array',
            'permissions' => 'array',
        ]);

        $user = User::findOrFail($request->user_id);

        // Assign roles
        $user->syncRoles($request->roles);

        // Assign permissions
        $user->syncPermissions($request->permissions);

        return redirect()->route('assign.roles')->with('success', 'Roles and permissions updated successfully!');
    }

    public function viewRoles()
    {
        $roles = Role::with('permissions')->get(); // Eager load permissions for each role
        return view('admin.roles', compact('roles'));
    }

    public function viewPermissions()
    {
        $permissions = Permission::all();
        return view('admin.permissions', compact('permissions'));
    }

    public function viewUsersWithRoles()
    {
        // Fetch users along with their roles and permissions
        $users = User::with(['roles.permissions'])->get(); // Eager load roles and permissions

        return view('admin.users_with_roles', compact('users'));
    }
}

