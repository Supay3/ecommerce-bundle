<?php

namespace App\Entity\Product;

use App\Entity\Product\Product;
use App\Repository\Product\ProductOptionRepository;
use DateTime;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;

/**
 * @ORM\Entity(repositoryClass=ProductOptionRepository::class)
 */
class ProductOption
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $name = null;

    /**
     * @ORM\ManyToMany(targetEntity=Product::class, mappedBy="productOptions")
     */
    private Collection $products;

    /**
     * @ORM\Column(type="datetime")
     */
    private ?DateTimeInterface $created_at = null;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?DateTimeInterface $updated_at = null;

    /**
     * @ORM\OneToMany(targetEntity=ProductOptionValue::class, mappedBy="productOption", orphanRemoval=true, cascade={"persist"})
     */
    private Collection $productOptionValues;

    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->productOptionValues = new ArrayCollection();
        $this->created_at = new DateTime();
    }

    #[Pure]
    public function __toString (): string
    {
        return $this->getName();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        $this->products->removeElement($product);

        return $this;
    }

    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getProductOptionValues(): Collection
    {
        return $this->productOptionValues;
    }
    /*
    public function addProductOptionValue (string $value): self
    {
        $productOptionValue = new ProductOptionValue();
        $productOptionValue->setName($value);
        if (!$this->productOptionValues->contains($productOptionValue)) {
            $this->productOptionValues[] = $productOptionValue;
            $productOptionValue->setProductOption($this);
        }
        return $this;
    }
    */


    public function addProductOptionValue(ProductOptionValue $productOptionValue): self
    {
        if (!$this->productOptionValues->contains($productOptionValue)) {
            $this->productOptionValues[] = $productOptionValue;
            $productOptionValue->setProductOption($this);
        }

        return $this;
    }


    public function removeProductOptionValue(ProductOptionValue $productOptionValue): self
    {
        if ($this->productOptionValues->removeElement($productOptionValue)) {
            // set the owning side to null (unless already changed)
            if ($productOptionValue->getProductOption() === $this) {
                $productOptionValue->setProductOption(null);
            }
        }

        return $this;
    }
}
