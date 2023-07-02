<?php

namespace App\Presentation\Forms;

use App\Domain\Entities\Product;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class)
            ->add('description', TextType::class)
            ->add('price', MoneyType::class)
            ->add('tax', IntegerType::class);

        $builder->addEventListener(FormEvents::POST_SUBMIT, [$this, 'setData']);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }

    public function setData(FormEvent $formEvent)
    {
        /** @var Product $product */
        $product = $formEvent->getData();

        $product->setPriceWithTax($product->getPrice()*(1+($product->getTax()/100)));
    }
}
