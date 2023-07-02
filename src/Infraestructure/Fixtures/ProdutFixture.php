<?php
namespace App\Infraestructure\Fixtures;

use App\Domain\Entities\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProdutFixture extends Fixture
{
    public const TAX_OPTIONS = array(4,10,21);

    public function load(ObjectManager $manager)
    {
        for ($i = 1 ; $i <= 100; $i++){
            $product = new Product();
            $product->setName('ProductName_'.$i);
            $product->setDescription('ProductDescription_'.$i);
            $price = random_int(1,999);
            $product->setPrice($price);
            $tax = ProdutFixture::TAX_OPTIONS[random_int(0,2)];
            $product->setTax($tax);
            $product->setPriceWithTax($price*(1+($tax/100)));

            $manager->persist($product);
        }

        $manager->flush();
    }

}
