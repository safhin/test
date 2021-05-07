<?php

namespace App\Repository\Eloquent;

use App\Models\Comment;
use App\Repository\Eloquent\BaseRepository;
use App\Repository\ICommentRepository;
use Illuminate\Support\Collection;

class CommentRepository extends BaseRepository implements ICommentRepository{

    public function __construct(Comment $model)
    {
        parent::__construct($model);
    }

    public function all(): Collection
    {
        return $this->model->all();
    }
}