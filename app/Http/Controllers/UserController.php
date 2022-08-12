<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        return view('admin.users.all', compact('users'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $permissions = Permission::all();
        $user->load('roles');
        return view('admin.users.edit', compact('user', 'roles', 'permissions'));
    }

    public function update(Request $request, User $user)
    {

        $this->validate($request, [
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'phone_number' => ['nullable', 'digits:11'],
            'password' => ['nullable'],
            'roles' => ['required', 'array'],
            'permissions' => ['required', 'array']
        ]);

        $data = $request->only('name', 'email', 'phone_number');


        if (isset($request->password))
            $data['password'] = Hash::make($request->password);


        $user->update($data);

        $user->freshPermissions($request->permissions);
        $user->freshRoles($request->roles);

        return redirect()->route('users')->with(['success_msg' => 'کاربر مورد نظر بروزرسانی شد.']);
    }

    public function destroy(User $user)
    {
        $user->detachRoles($user->roles);
        $user->detachPermissions($user->permissions);

        $user->delete();

        return redirect()->route('users')->with(['success_msg' => 'کاربر مورد نظر حذف شد.']);
    }
}
