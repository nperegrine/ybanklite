<?php

namespace App\Repository;

class Repository implements RepositoryInterface
{
    protected $items;
    protected $error;
    protected $errorMessage;

    public function getItems()
    {
        return $this->items;
    }

    public function setItems($items): Repository
    {
        $this->items = $items;

        return $this;
    }

    public function setError(Bool $error): Repository
    {
        $this->error = $error;

        return $this;
    }

    public function setErrorMessage(string $errorMessage): Repository
    {
        $this->errorMessage = $errorMessage;

        return $this;
    }

    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }

    public function hasError(): Bool
    {
        return $this->error;
    }
}