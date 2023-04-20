<?php

namespace App\Shop\Domain\Product;

interface ProductRepository
{
    public function saveProduct(Product $product);

    public function deleteProduct(Product $product);

    public function findById(int $productId);


}