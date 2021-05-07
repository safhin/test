<?php

namespace App\Repository;
use Illuminate\Support\Collection;

interface ICategoryRepository{
    public function all(): Collection;
}