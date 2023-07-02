<?php
namespace App\Application\UseCase;

use App\Application\Contracts\ProductRepositoryInterface;
use App\Presentation\Filters\ProductFilter;

class GetProductsUseCase
{
    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }


    public function execute(array $data)
    {
        $filter = new ProductFilter($data);

        return $this->productRepository->getProducts($filter);
    }
}
