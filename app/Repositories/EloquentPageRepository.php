<?php

namespace App\Repositories;

use App\Models\Page;

class EloquentPageRepository implements PageRepository
{
    private $model;

    public function __construct(Page $page)
    {
        $this->model = $page;
    }

    public function getAll()
    {
        return $this->model->get();
    }
}
