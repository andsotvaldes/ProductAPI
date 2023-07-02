<?php

namespace App\Presentation\Controllers;

use App\Application\UseCase\CreateProductUseCase;
use App\Domain\Entities\Product;
use App\Presentation\Forms\ProductForm;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Nelmio\ApiDocBundle\Annotation\Security;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Model;

class CreateProductController extends BaseController
{
    /**
     * Create a product.
     *
     * This call retrieve create a product
     *
     * @OA\Response(
     *     response=200,
     *     description="Returns the product",
     *     @OA\JsonContent(ref=@Model(type=Product::class))
     * )
     * @OA\RequestBody(@Model(type=ProductForm::class))
     * @OA\Tag(name="Products")
     * @Security(name="Bearer")
     */
    #[Route('/v1/product', name: 'createProduct', methods:"POST")]
    public function createProduct(Request $request, CreateProductUseCase $useCase){
        try {
            $product = new Product();

            $form = $this->createForm(ProductForm::class,$product);

            return $this->returnJSONCall(JsonResponse::HTTP_OK,'OK',$useCase->execute($product,$form,json_decode($request->getContent(),true)));
        }catch (\Exception $exception){
            return $this->returnJSONCall(JsonResponse::HTTP_INTERNAL_SERVER_ERROR,'ERROR',['error'=>json_decode($exception->getMessage())]);
        }
    }
}
