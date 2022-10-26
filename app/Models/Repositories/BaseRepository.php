<?php

namespace App\Models\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    /**
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
}
