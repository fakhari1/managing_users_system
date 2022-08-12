<?php

namespace App\Services\Authorization\Traits;

use App\Models\Permission;
use Illuminate\Support\Arr;

trait HasPermission
{
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function attachPermissions(...$permissions)
    {
        $permissions = $this->getAllPermissions($permissions);

        if ($permissions->isEmpty())
            return $this;

        $this->permissions()->syncWithoutDetaching($permissions);

        return $this;
    }

    public function detachPermissions(...$permissions)
    {
        $permissions = $this->getAllPermissions($permissions);

        $this->permissions()->detach($permissions);

        return $this;
    }

    public function freshPermissions(...$permissions)
    {
        $permissions = $this->getAllPermissions($permissions);

        $this->permissions()->sync($permissions);

        return $this;
    }

    protected function getAllPermissions(array $permissions)
    {
        return Permission::query()->whereIn('name', Arr::flatten($permissions))->get();
    }

    public function hasPermission(Permission $permission)
    {
        return $this->hasPermissionsThroughRoles($permission) || $this->permissions()->exists($permission);
//        return $this->permissions->contains('name', $permission);
    }

    protected function hasPermissionsThroughRoles(Permission $permission)
    {
        $roles = $permission->roles()->get();

        foreach ($roles as $key => $role) {
            if ($this->roles->contains($role)) return true;
        }

        return false;
    }
}
