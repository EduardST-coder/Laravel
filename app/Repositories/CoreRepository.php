<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CoreRepository.
 * Базовий репозиторій для читання сутностей.
 */
abstract class CoreRepository
{
    /**
     * @var Model
     */
    protected $model;

    public function __construct()
    {
        $this->model = app($this->getModelClass());
    }

    /**
     * Повертає ім’я класу моделі.
     * @return mixed
     */
    abstract protected function getModelClass();

    /**
     * Стартова модель (клонується).
     * @return Model
     */
    protected function startConditions()
    {
        return clone $this->model;
    }
}
