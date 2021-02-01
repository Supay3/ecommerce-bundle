<?php

namespace App\Entity\Product;

use App\Repository\Product\ProductOptionValueRepository;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;

/**
 * @ORM\Entity(repositoryClass=ProductOptionValueRepository::class)
 */
class ProductOptionValue
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @ORM\ManyToOne(targetEntity=ProductOption::class, inversedBy="productOptionValues")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?ProductOption $productOption = null;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $name = null;

    #[Pure]
    public function __toString (): string
    {
        return $this->getName();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductOption(): ?ProductOption
    {
        return $this->productOption;
    }

    public function setProductOption(?ProductOption $productOption): self
    {
        $this->productOption = $productOption;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
