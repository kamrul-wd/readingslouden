<?php

namespace App\Models;

trait HasRoles
{
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function assignRole($role)
    {
        return $this->roles()->sync(
            Role::whereName($role)->firstOrFail()
        );
    }

    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->roles->contains('slug', $role);
        }

        // If collection
        return !! $role->intersect($this->roles)->count();
    }

    public function hasRoles($roles)
    {
        if (is_string($roles)) {
            return $this->roles->contains('slug', $roles);
        }

        foreach ($roles as $role) {
            return $this->roles->contains('slug', $role);
        }
    }

    public function containsRoles($roles)
    {
        if (is_string($roles)) {
            return $this->roles->contains('slug', $roles);
        }

        foreach ($roles as $role) {
            if ($this->roles->contains('slug', $role)) {
                return true;
            }
        }

        return false;
    }
}
