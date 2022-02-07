<?php

declare(strict_types=1);

namespace Ecommerce\Product\Domain;

final class ProductWithCalculatedDiscount
{
    public function __construct(
        private ProductId $id,
        private ProductSku $sku,
        private ProductCategory $category,
        private ProductName $name,
        private ProductCalculatedDiscount $calculatedDiscount,
    ) {
    }

    public function id(): ProductId
    {
        return $this->id;
    }

    public function sku(): ProductSku
    {
        return $this->sku;
    }

    public function category(): ProductCategory
    {
        return $this->category;
    }

    public function name(): ProductName
    {
        return $this->name;
    }

    public function calculatedDiscount(): ProductCalculatedDiscount
    {
        return $this->calculatedDiscount;
    }
}