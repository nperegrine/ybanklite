<?php

namespace App\Repository;

interface TransactionRepositoryInterface
{
    public function all();
    public function find($id);
    public function store(array $data);
}