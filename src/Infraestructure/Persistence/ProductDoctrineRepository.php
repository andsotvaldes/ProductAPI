<?php
namespace App\Infraestructure\Persistence;

use App\Application\Contracts\ProductRepositoryInterface;
use App\Domain\Entities\Product;
use App\Presentation\Filters\ProductFilter;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;

class ProductDoctrineRepository implements ProductRepositoryInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getProducts(ProductFilter $filter)
    {
        $queryBuilder = $this->entityManager->getRepository(Product::class)
            ->createQueryBuilder('product');

        if(!empty($filter->getFilterName())){
            $queryBuilder->where('product.name like :name')
                ->setParameter('name','%'.$filter->getFilterName().'%');
        }

        $queryBuilder
            ->setFirstResult(($filter->getCurrentPage() - 1) * $filter->getPageSize())
            ->setMaxResults($filter->getPageSize());

        $paginator = new Paginator($queryBuilder);
        $totalItems = $paginator->count();
        $totalPages = ceil($totalItems / $filter->getPageSize());
        $items = $paginator->getIterator()->getArrayCopy();

        return $response = [
            'items' => $items,
            'totalItems' => $totalItems,
            'totalPages' => $totalPages,
            'currentPage' => $filter->getCurrentPage(),
            'pageSize' => $filter->getPageSize(),
        ];
    }

    public function saveProduct(Product $product)
    {
        $this->entityManager->persist($product);
        $this->entityManager->flush();

        return $product;
    }
}
