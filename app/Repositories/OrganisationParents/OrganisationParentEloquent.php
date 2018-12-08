<?php

namespace App\Repositories\OrganisationParents;
use App\Repositories\EloquentRepository;
use App\Repositories\OrganisationParents\OrganisationParentInterface;

class OrganisationParentEloquent extends EloquentRepository implements OrganisationParentInterface
{
    public function getModel()
    {
        return \App\Models\OrganisationParent::class;
    }

    public function getName()
    {
        return $this->_model->select('name')->get();
    }
}
