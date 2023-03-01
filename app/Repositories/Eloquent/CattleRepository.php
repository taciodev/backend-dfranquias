<?php

namespace App\Repositories\Eloquent;

use App\Models\Cattle;
use App\Repositories\Contracts\CattleRepositoryInterface;

class CattleRepository extends AbstractRepository implements CattleRepositoryInterface
{
    protected $model = Cattle::class;
}

// private $model;
