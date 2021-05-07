<?php

namespace App\Repository\Eloquent;

use App\Models\Tag;
use App\Repository\IPostRepository;
use App\Repository\Eloquent\BaseRepository;
use App\Repository\ITagRepository;
use Illuminate\Support\Collection;

class TagRepository extends BaseRepository implements ITagRepository{

    public function __construct(Tag $model)
    {
        parent::__construct($model);
    }

    public function all(): Collection
    {
        return $this->model->all();
    }
}