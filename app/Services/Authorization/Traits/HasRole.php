<?php

namespace App\Services\Authorization\Traits;

use App\Models\Role;
use Illuminate\Support\Arr;

trait HasRole
{
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function attachRoles(...$roles)
    {
        $roles = $this->getAllRoles($roles);

        if ($roles->isEmpty())
            return $this;

        $this->roles()->syncWithoutDetaching($roles);

        return $this;
    }

    public function detachRoles(...$roles)
    {
        $roles = $this->getAllRoles($roles);

        if ($roles->isEmpty())
            return $this;

        $this->roles()->detach($roles);

        return $this;
    }

    public function freshRoles(...$roles)
    {
        $roles = $this->getAllRoles($roles);

        if ($roles->isEmpty())
            return $this;

        $this->roles()->sync($roles);

        return $this;
    }


    public function getAllRoles(array $roles)
    {
        return Role::query()->whereIn('name', Arr::flatten($roles))->get();
    }

    public function hasRole(string $role)
    {
        return $this->roles()->exists($role);
    }
}
