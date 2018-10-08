<?php

namespace App\Repositories\OrganisationCities;

use App\Repositories\EloquentRepository;
use App\OrganisationCity;

class OrganisationCityRepository extends EloquentRepository implements OrganisationCityInterface
{
    public function getModel ()
    {
        return \App\Models\OrganisationCity::class;
    }

    public function getNameCity()
    {
        return OrganisationCity::select('name')->get();
    }
}
