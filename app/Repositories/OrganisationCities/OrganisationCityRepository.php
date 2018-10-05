<?php

namespace App\Repositories\OrganisationCities;

use App\Repositories\EloquentRepository;

class OrganisationCityRepository extends EloquentRepository
{
    public function getModel ()
    {
        return \App\Models\OrganisationCity::class;
    }
}
