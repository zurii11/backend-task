<?php

namespace App\Classes;

class Cart
{
    private array $products;

    public function __construct(array $products)
    {
        $this->products = $products;
    }

    public function getProducts() : array
    {
        return $this->products;
    }
}
