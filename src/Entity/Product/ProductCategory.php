<?php

namespace App\Entity\Product;

use App\Entity\Product\Product;
use App\Repository\Product\ProductCategoryRepository;
use DateTime;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductCategoryRepository::class)
 */
class ProductCategory
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
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $description = null;

    /**
     * @ORM\Column(type="datetime")
     */
    private ?DateTimeInterface $created_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?DateTimeInterface $updated_at = null;

    /**
     * @ORM\OneToMany(targetEntity=Product::class, mappedBy="productCategory")
     */
    private Collection $products;

    /**
     * @ORM\ManyToOne(targetEntity=ProductCategory::class, inversedBy="productCategories")
     */
    private ?ProductCategory $productCategory = null;

    /**
     * @ORM\OneToMany(targetEntity=ProductCategory::class, mappedBy="productCategory")
     */
    private Collection $productCategories;

    /**
     * @ORM\Column(type="boolean")
     */
    private int $primaryCategory = 0;

    public function __construct()
    {
        $this->created_at = new DateTime();
        $this->products = new ArrayCollection();
        $this->productCategories = new ArrayCollection();
    }

    public function __toString(): string
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

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
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->setProductCategory($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getProductCategory() === $this) {
                $product->setProductCategory(null);
            }
        }

        return $this;
    }

    public function getProductCategory(): ?self
    {
        return $this->productCategory;
    }

    public function setProductCategory(?self $productCategory): self
    {
        $this->productCategory = $productCategory;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getProductCategories(): Collection
    {
        return $this->productCategories;
    }

    public function addProductCategory(self $productCategory): self
    {
        if (!$this->productCategories->contains($productCategory)) {
            $this->productCategories[] = $productCategory;
            $productCategory->setProductCategory($this);
        }

        return $this;
    }

    public function removeProductCategory(self $productCategory): self
    {
        if ($this->productCategories->removeElement($productCategory)) {
            // set the owning side to null (unless already changed)
            if ($productCategory->getProductCategory() === $this) {
                $productCategory->setProductCategory(null);
            }
        }

        return $this;
    }

    public function getPrimaryCategory(): ?bool
    {
        return $this->primaryCategory;
    }

    public function setPrimaryCategory(bool $primaryCategory): self
    {
        $this->primaryCategory = $primaryCategory;

        return $this;
    }
}
