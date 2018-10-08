<?php

namespace App\Http\Controllers\Organisations;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\OrganisationCities\OrganisationCityInterface;
use App\Http\Resources\OrganisationCity;

class OrganisationCityController extends Controller
{
    protected $organisationCity;
    public function __construct(OrganisationCityInterface $organisationCity)
    {
        $this->organisationCity = $organisationCity;
    }

    public function index()
    {
        $cities = $this->organisationCity->getNameCity();

        return OrganisationCity::collection($cities);
    }
}
