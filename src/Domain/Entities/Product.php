<?php
namespace App\Domain\Entities;

use App\Domain\Repository\ProductRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Type('string')]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Type('string')]
    private ?string $description = null;

    #[ORM\Column]
    #[Assert\Type('float')]
    #[Assert\PositiveOrZero]
    #[Assert\NotNull]
    private ?float $price = null;

    #[ORM\Column]
    #[Assert\Type('float')]
    #[Assert\PositiveOrZero]
    #[Assert\NotNull]
    private ?float $priceWithTax = null;

    #[ORM\Column]
    #[Assert\Type('int')]
    #[Assert\NotNull]
    #[Assert\Choice(choices: [4, 10, 21], message: 'Only valid 4, 10 or 21')]
    private ?int $tax = null;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return float|null
     */
    public function getPrice(): ?float
    {
        return $this->price;
    }

    /**
     * @param float|null $price
     */
    public function setPrice(?float $price): void
    {
        $this->price = $price;
    }

    /**
     * @return float|null
     */
    public function getPriceWithTax(): ?float
    {
        return $this->priceWithTax;
    }

    /**
     * @param float|null $priceWithTax
     */
    public function setPriceWithTax(?float $priceWithTax): void
    {
        $this->priceWithTax = $priceWithTax;
    }

    /**
     * @return int|null
     */
    public function getTax(): ?int
    {
        return $this->tax;
    }

    /**
     * @param int|null $tax
     */
    public function setTax(?int $tax): void
    {
        $this->tax = $tax;
    }


}
