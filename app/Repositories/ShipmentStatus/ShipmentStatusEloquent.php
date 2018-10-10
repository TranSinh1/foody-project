<?php

namespace App\Repositories\ShipmentStatus;

use App\Repositories\EloquentRepository;
use App\Repositories\ShipmentStatus\ShipmentStatusInterface;

class ShipmentStatusEloquent extends EloquentRepository implements ShipmentStatusInterface
{
    public function getModel()
    {
        return \App\Models\ShipmentStatus::class;
    }
    
    public function getNameShipmentStatus ()
    {
        return $this->_model->select('status')->get();
    }
}
