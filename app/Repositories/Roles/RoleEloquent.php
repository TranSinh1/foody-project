<?php

namespace App\Repositories\Roles;

use App\Repositories\EloquentRepository;
use App\Repositories\Roles\RoleInterface;

class RoleEloquent extends EloquentRepository implements RoleInterface
{
    public function getModel ()
    {
        return \App\Models\Role::class;
    }

    public function getNameRole()
    {
        return $this->_model::select('name')->get();
    }
}
