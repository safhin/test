<?php

namespace App\Repository\Eloquent;

use App\Models\Category;
use App\Repository\Eloquent\BaseRepository;
use App\Repository\ICategoryRepository;
use Illuminate\Support\Collection;

class CategoryRepository extends BaseRepository implements ICategoryRepository{

    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    public function all(): Collection
    {
        return $this->model->all();
    }
}