<?php

namespace App\Repositories\Contracts;

interface CattleRepositoryInterface
{
    public function all();
    public function get($code);
    public function create(array $data);
    public function update(array $data, $code);
    public function delete($code);
}
