<?php
namespace App\Application\Contracts;

use App\Domain\Entities\Product;
use App\Presentation\Filters\ProductFilter;

interface ProductRepositoryInterface
{
    public function getProducts(ProductFilter $filter);

    public function saveProduct(Product $product);
}
