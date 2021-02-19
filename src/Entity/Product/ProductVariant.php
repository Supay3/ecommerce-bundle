<?php

namespace App\Entity\Product;

use App\Repository\Product\ProductVariantRepository;
use DateTime;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductVariantRepository::class)
 */
class ProductVariant
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="productVariants")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Product $product = null;

    /**
     * @ORM\ManyToMany(targetEntity=ProductOptionValue::class, inversedBy="productVariants")
     */
    private Collection $productOptionValues;

    /**
     * @ORM\Column(type="float")
     */
    private ?float $price = null;

    /**
     * @ORM\Column(type="integer")
     */
    private ?int $stock = null;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private ?float $width = null;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private ?float $height = null;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private ?float $depth = null;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private ?float $weight = null;

    /**
     * @ORM\Column(type="datetime")
     */
    private ?DateTimeInterface $created_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?DateTimeInterface $updated_at = null;

    public function __construct()
    {
        $this->created_at = new DateTime();
        $this->productOptionValues = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getProductOptionValues(): Collection
    {
        return $this->productOptionValues;
    }

    public function addProductOptionValue(ProductOptionValue $productOptionValue): self
    {
        if (!$this->productOptionValues->contains($productOptionValue)) {
            $this->productOptionValues[] = $productOptionValue;
        }

        return $this;
    }

    public function removeProductOptionValue(ProductOptionValue $productOptionValue): self
    {
        $this->productOptionValues->removeElement($productOptionValue);

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getWidth(): ?float
    {
        return $this->width;
    }

    public function setWidth(?float $width): self
    {
        $this->width = $width;

        return $this;
    }

    public function getHeight(): ?float
    {
        return $this->height;
    }

    public function setHeight(?float $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function getDepth(): ?float
    {
        return $this->depth;
    }

    public function setDepth(?float $depth): self
    {
        $this->depth = $depth;

        return $this;
    }

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setWeight(?float $weight): self
    {
        $this->weight = $weight;

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

    public function getName (): ?string
    {
        return $this->product->getName() . ' Variant';
    }
}
