<?php

namespace App\Classes;

class Algorithm
{
    
    public $cart;     
    public $store1;
    public $store2;
    public $store3; 
    public $stores;


    public function main()
    {
        $this->cart = new Cart([
            new Product(1, 2),
            new Product(2, 2),
            new Product(3, 2)
        ]);

        $this->store1 =  new Store(1, 'store1', [
            new Inventory(3, 2, 10),
            new Inventory(2, 2, 10)
        ]);

        $this->store2 = new Store(2, 'store2', [
            new Inventory(1, 2, 10),
            new Inventory(3, 2, 10)
        ]);

        $this->store3 = new Store(3, 'store3', [
            new Inventory(1, 2, 10)
        ]);

        $this->stores = [
            $this->store1,
            $this->store2,
            $this->store3
        ];

        dd($this->assign($this->cart, $this->stores));
    }

    public function assign(?Cart $cart, array $stores)
    {
        $products = $cart->getProducts();
        $arr = [];

        foreach ($stores as $store)
        {
            $found = array();
            foreach ($products as $product)
            {
                if ($store->has($product))
                {
                    $found[$product->getId()] = $product;
                }
            }

            /*
             * if more than 1 product found then save it for further use
             * else assign store to the product. 
             */
            if (count($found) > 1)
            {
                $arr[$store->getId()] = $found;
            }
            else
            {
                if (array_values($found)[0]->getStore() === NULL) array_values($found)[0]->setStore($store);
            }
        }

        for ($i = 1; $i <= count($arr); $i++)
        {
            for ($j = $i+1; $j <= count($arr); $j++)
            {
                /*
                 * when 2 stores have overlap in what produts they can deliver
                 * store with higher priority is assigned
                 */
                if ($diffKey = array_diff_key($arr[$j], $arr[$i]))
                {
                    array_map(function($store) use($i, $j, $arr, $diffKey) {
                        if ($store->getId() == $i)
                        {
                            foreach ($arr[$i] as $product)
                            {
                                $product->setStore($store);
                            }
                        }
                        else if ($store->getId() == $j)
                        {
                            foreach ($diffKey as $product)
                            {
                                $product->setStore($store);
                            } 
                        }
                    }, $stores);
                }
                else
                {
                    $index = rand($i, $j);
                    array_map(function($store) use ($index, $arr) {
                        if ($store->getId() == $index)
                        {
                            foreach ($arr[$index] as $product)
                            {
                                $product->setStore($store);
                            }  
                        }
                    }, $stores);
                                        
                }
            }
        }

        return $cart;
        //return array_diff_key($arr[2], $arr[1]);
        //return $arr;
    }

}
