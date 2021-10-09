<?php

namespace App\Classes;

class Store
{
    private int $id;
    private string $name;
    private array $inventory;

    public function __construct(int $id, string $name, array $inventory)
    {
        $this->id = $id;
        $this->name = $name;
        $this->inventory = $inventory;
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getInventory() : array
    {
        return $this->inventory;
    }

    public function has(?Product $product) : bool
    {
        foreach ($this->inventory as $item)
        {
            if ($item->getId() === $product->getId())
            {
                return true;
            }
            else
            {
                continue;
            }
        }

        return false;
    }
}
