<?php

namespace App\Repository;

interface AccountRepositoryInterface
{
    public function all();
    public function find($id);
    public function store(array $data);
    public function update(array $data, $id);
    public function delete($id);
    public function getTransactionsByAccount($id);
}