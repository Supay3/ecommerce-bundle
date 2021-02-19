<?php

namespace App\Entity\Product;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\Product\ProductRepository;
use DateTime;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\String\AbstractString;
use Symfony\Component\String\UnicodeString;
use function Symfony\Component\String\u;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
#[ApiResource(attributes: [
    'normalization_context' => ['groups' => ['read:product']]
])]
class Product
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
    #[Groups(['read:product'])]
    private ?string $name = null;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    #[Groups(['read:product'])]
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
     * @ORM\OneToMany(targetEntity=ProductAttributeValue::class, mappedBy="product", orphanRemoval=true, cascade="persist")
     */
    private Collection $productAttributeValues;

    /**
     * @ORM\ManyToMany(targetEntity=ProductOption::class, inversedBy="products")
     */
    private Collection $productOptions;

    /**
     * @ORM\ManyToOne(targetEntity=ProductCategory::class, inversedBy="products")
     */
    private ?ProductCategory $productCategory = null;

    /**
     * @ORM\OneToMany(targetEntity=ProductVariant::class, mappedBy="product", orphanRemoval=true)
     */
    private Collection $productVariants;

    public function __construct()
    {
        $this->productAttributeValues = new ArrayCollection();
        $this->productOptions = new ArrayCollection();
        $this->created_at = new DateTime();
        $this->productVariants = new ArrayCollection();
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

    public function getDescriptionExcerpt(): AbstractString|UnicodeString
    {
        return u($this->getDescription())->truncate(60, '...', false);
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
    public function getProductAttributeValues(): Collection
    {
        return $this->productAttributeValues;
    }

    public function addProductAttributeValue(ProductAttributeValue $productAttributeValue): self
    {
        if (!$this->productAttributeValues->contains($productAttributeValue)) {
            $this->productAttributeValues[] = $productAttributeValue;
            $productAttributeValue->setProduct($this);
        }

        return $this;
    }

    public function removeProductAttributeValue(ProductAttributeValue $productAttributeValue): self
    {
        if ($this->productAttributeValues->removeElement($productAttributeValue)) {
            // set the owning side to null (unless already changed)
            if ($productAttributeValue->getProduct() === $this) {
                $productAttributeValue->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection
     */
    public function getProductOptions(): Collection
    {
        return $this->productOptions;
    }

    public function addProductOption(ProductOption $productOption): self
    {
        if (!$this->productOptions->contains($productOption)) {
            $this->productOptions[] = $productOption;
            $productOption->addProduct($this);
        }

        return $this;
    }

    public function removeProductOption(ProductOption $productOption): self
    {
        if ($this->productOptions->removeElement($productOption)) {
            $productOption->removeProduct($this);
        }

        return $this;
    }

    public function getProductCategory(): ?ProductCategory
    {
        return $this->productCategory;
    }

    public function setProductCategory(?ProductCategory $productCategory): self
    {
        $this->productCategory = $productCategory;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getProductVariants(): Collection
    {
        return $this->productVariants;
    }

    public function addProductVariant(ProductVariant $productVariant): self
    {
        if (!$this->productVariants->contains($productVariant)) {
            $this->productVariants[] = $productVariant;
            $productVariant->setProduct($this);
        }

        return $this;
    }

    public function removeProductVariant(ProductVariant $productVariant): self
    {
        if ($this->productVariants->removeElement($productVariant)) {
            // set the owning side to null (unless already changed)
            if ($productVariant->getProduct() === $this) {
                $productVariant->setProduct(null);
            }
        }

        return $this;
    }
}
