<?php

namespace App\Repository;
use Illuminate\Support\Collection;

interface IPostRepository{
    public function all(): Collection;
}