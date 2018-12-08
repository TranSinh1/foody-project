<?php

namespace App\Repositories\ConfirmType;

use App\Repositories\EloquentRepository;
use App\Repositories\ConfirmType\ConfirmTypeInterface;

class ConfirmTypeEloquent extends EloquentRepository implements ConfirmTypeInterface
{
    public function getModel()
    {
        return \App\Models\ConfirmType::class;
    }
    
    public function getNameConfirmType()
    {
        return $this->_model->select('name')->get();
    }
}
