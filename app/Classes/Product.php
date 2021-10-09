<?php

namespace App\Classes;

class Product
{
    private int $id;
    private int $sizeId;
    private ?Store $store = NULL;

    public function __construct(int $id, int $sizeId)
    {
        $this->id = $id;
        $this->sizeId = $sizeId;
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function getSize() : int
    {
        return $this->sizeId;
    }

    public function getStore() : ?Store
    {
        return $this->store;
    }

    public function setStore(?Store $store)
    {
        $this->store = $store;
    }
}
