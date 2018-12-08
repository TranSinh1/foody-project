<?php

namespace App\Repositories\OrganisationCities;

use App\Repositories\EloquentRepository;
use App\Models\OrganisationCity;

class OrganisationCityRepository extends EloquentRepository implements OrganisationCityInterface
{
    public function getModel()
    {
        return \App\Models\OrganisationCity::class;
    }

    public function getNameCity()
    {
        return $this->_model->select('name')->get();
    }
}
