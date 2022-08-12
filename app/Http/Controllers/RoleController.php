<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.all', compact('roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string'],
            'persian_name' => ['required', 'string']
        ]);

        Role::query()->create($request->only('name', 'persian_name'));

        return redirect()->back()->with(['success_msg' => 'نقش مورد نظر ثبت شد.']);
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        $role->load('permissions');
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $this->validate($request, [
            'name' => ['required', 'string'],
            'persian_name' => ['required', 'string'],
            'permissions' => ['required', 'array']
        ]);

        $role->update($request->only('name', 'persian_name'));
        $role->freshPermissions($request->permissions);

        return redirect()->route('roles')->with(['success_msg' => 'نقش مورد نظر بروزرسانی شد.']);
    }

    public function destroy(Role $role)
    {

    }
}
