<?php

namespace App\Http\Controllers\Organisations;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\OrganisationCities\OrganisationCityRepository;
use App\Http\Resources\OrganisationCity;

class OrganisationCityController extends Controller
{
    protected $organisationCity;

    public function __construct(OrganisationCityRepository $organisationCity)
    {
        $this->organisationCity = $organisationCity;
    }

    public function index()
    {
        $cities = $this->organisationCity->getAll();

        return OrganisationCity::collection($cities);
    }
}
