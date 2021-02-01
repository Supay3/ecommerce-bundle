<?php

namespace App\Entity\Product;

use App\Repository\Product\ProductAttributeValueRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductAttributeValueRepository::class)
 */
class ProductAttributeValue
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="productAttributeValues")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Product $product;

    /**
     * @ORM\ManyToOne(targetEntity=ProductAttribute::class, inversedBy="productAttributeValues")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?ProductAttribute $attribute;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $textValue;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private ?bool $booleanValue;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $integerValue;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private ?float $floatValue;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?DateTimeInterface $datetimeValue;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private ?DateTimeInterface $dateValue;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private ?array $jsonValue = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    /**
     * @param Product|null $product
     * @return $this
     */
    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getAttribute(): ?ProductAttribute
    {
        return $this->attribute;
    }

    public function setAttribute(?ProductAttribute $attribute): self
    {
        $this->attribute = $attribute;

        return $this;
    }

    public function getTextValue(): ?string
    {
        return $this->textValue;
    }

    public function setTextValue(?string $textValue): self
    {
        $this->textValue = $textValue;

        return $this;
    }

    public function getBooleanValue(): ?bool
    {
        return $this->booleanValue;
    }

    public function setBooleanValue(?bool $booleanValue): self
    {
        $this->booleanValue = $booleanValue;

        return $this;
    }

    public function getIntegerValue(): ?int
    {
        return $this->integerValue;
    }

    public function setIntegerValue(?int $integerValue): self
    {
        $this->integerValue = $integerValue;

        return $this;
    }

    public function getFloatValue(): ?float
    {
        return $this->floatValue;
    }

    public function setFloatValue(?float $floatValue): self
    {
        $this->floatValue = $floatValue;

        return $this;
    }

    public function getDatetimeValue(): ?DateTimeInterface
    {
        return $this->datetimeValue;
    }

    public function setDatetimeValue(?DateTimeInterface $datetimeValue): self
    {
        $this->datetimeValue = $datetimeValue;

        return $this;
    }

    public function getDateValue(): ?DateTimeInterface
    {
        return $this->dateValue;
    }

    public function setDateValue(?DateTimeInterface $dateValue): self
    {
        $this->dateValue = $dateValue;

        return $this;
    }

    public function getJsonValue(): ?array
    {
        return $this->jsonValue;
    }

    public function setJsonValue(?array $jsonValue): self
    {
        $this->jsonValue = $jsonValue;

        return $this;
    }
}
