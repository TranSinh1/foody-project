<?php

namespace App\Repositories;

use App\Repositories\RepositoryInterface;

abstract class EloquentRepository implements RepositoryInterface
{
    protected $_model;

    public function __construct ()
    {
        $this->setModel();
    }

    abstract public function getModel ();

    public function setModel ()
    {
        $this->_model = app()->make(
            $this->getModel()
        );
    }

    public function getAll ()
    {
        return $this->_model->all();
    }

    public function find ($id)
    {
        $result = $this->_model->find($id);

        return $result;
    }

    public function create (array $data)
    {
        $result = $this->_model->create($data);

        return $result;
    }

    public function update ($id, array $data)
    {
        $result = $this->_model->find($id);

        if(! $result) {
            return false;
        }

        $result->update($data);

        return $result;
    }

    public function delete ($id)
    {
        $result = $this->_model->find($id);

        if(! $result) {
            return false;
        }

        $result->delete();

        return true;
    }


}
