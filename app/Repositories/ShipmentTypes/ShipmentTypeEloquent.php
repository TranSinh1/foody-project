<?php

namespace App\Repositories\ShipmentTypes;

use App\Repositories\EloquentRepository;
use App\Repositories\ShipmentTypes\ShipmentTypeInterface;

class ShipmentTypeEloquent extends EloquentRepository implements ShipmentTypeInterface
{
    public function getModel()
    {
        return \App\Models\ShipmentType::class;
    }
    
    public function getNameShipmentType ()
    {
        return $this->_model->select('name')->get();
    }
}
