<?php

namespace App\Presentation\Controllers;

use App\Application\UseCase\GetProductsUseCase;
use App\Domain\Entities\Product;
use App\Presentation\Forms\ProductForm;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;

class GetProductsController extends BaseController
{
    /**
     * List the products.
     *
     * This call retrieve all the products of the applicatins
     *
     * @OA\Response(
     *     response=200,
     *     description="Returns the products",
     *     @OA\JsonContent(
     *        type="array",
     *        @OA\Items(ref=@Model(type=Product::class))
     *     )
     * )
     * @OA\Parameter(
     *     name="Content-type",
     *     in="header",
     *     description="The field header to send",
     *     @OA\Schema(type="string")
     * )
     * @OA\Parameter(
     *     name="name",
     *     in="query",
     *     description="The field used to filter by name",
     *     @OA\Schema(type="string")
     * )
     * @OA\Parameter(
     *     name="currentPage",
     *     in="query",
     *     description="The field used to paginate the products",
     *     @OA\Schema(type="string")
     * )
     * @OA\Parameter(
     *     name="pageSize",
     *     in="query",
     *     description="The field used to retirve a number of products of the array for paginate",
     *     @OA\Schema(type="string")
     * )
     * @OA\Tag(name="Products")
     */
    #[Route('/v1/products', name: 'getProducts', methods:"GET")]
    public function getAllProducts(Request $request, GetProductsUseCase $useCase){
        try {
            return $this->returnJSONCall(JsonResponse::HTTP_OK,'OK',$useCase->execute($request->query->all()));
        }catch (\Exception $exception){
            return $this->returnJSONCall(JsonResponse::HTTP_INTERNAL_SERVER_ERROR,'ERROR',['error'=>$exception->getMessage()]);
        }
    }
}
