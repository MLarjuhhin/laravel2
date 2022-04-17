<?php

namespace App\Repositories;

/**
 * репозитори для работы с сущностю
 * Может выдавать наборы данных
 * Не может создавать или изменять сушность
 */


abstract class CoreRepository
{

    /**
     * @var Model
     */
    protected $model;

    public function __construct()
    {
        $this->model=app($this->getModelClass());
    }

    /**
     * @retrun  $mixed
     */

    abstract protected function getModelClass();

    protected function startConditions(){
        return clone $this->model;
    }
}
