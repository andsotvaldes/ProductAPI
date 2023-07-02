<?php
namespace App\Application\UseCase;

use App\Application\Contracts\ProductRepositoryInterface;
use App\Domain\Entities\Product;
use Symfony\Component\Form\Form;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreateProductUseCase
{
    private $validator;
    private $productRepository;

    public function __construct(ValidatorInterface $validator,ProductRepositoryInterface $productRepository)
    {
        $this->validator = $validator;
        $this->productRepository = $productRepository;
    }


    public function execute(Product $product,Form $form,array $data)
    {
        $form->submit($data);

        $errors = $this->validator->validate($product);
        if (count($errors) > 0) {
            $JSONResponse = [

            ];

            foreach ($errors as $error){
                $JSONResponse[$error->getPropertyPath()] = $error->getMessage() ;
            }
            throw new \Exception(json_encode($JSONResponse));
        }

        return $this->productRepository->saveProduct($product);
    }
}
