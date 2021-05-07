<?php

namespace App\Repository;
use Illuminate\Support\Collection;

interface ITagRepository{
    public function all(): Collection;
}