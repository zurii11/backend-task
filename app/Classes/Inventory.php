<?php

namespace App\Classes;

class Inventory
{
    private int $id;
    private int $sizeId;
    private int $quantity;

    public function __construct(int $id, int $sizeId, int $quantity)
    {
        $this->id = $id;
        $this->sizeId = $sizeId;
        $this->quantity = $quantity;
    }
    
    public function getId() : int
    {
        return $this->id;
    }

    public function getSize() : int
    {
        return $this->sizeId;
    }

    public function getQuantity() : int
    {
        return $this->quantity;
    }
}
