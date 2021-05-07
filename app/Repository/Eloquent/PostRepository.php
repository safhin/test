<?php

namespace App\Repository\Eloquent;

use App\Models\Post;
use App\Repository\IPostRepository;
use App\Repository\Eloquent\BaseRepository;
use Illuminate\Support\Collection;

class PostRepository extends BaseRepository implements IPostRepository{

    public function __construct(Post $model)
    {
        parent::__construct($model);
    }

    public function all(): Collection
    {
        return $this->model->all();
    }
}