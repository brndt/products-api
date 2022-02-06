<?php

declare(strict_types=1);

namespace Ecommerce\Product\Domain;

final class Product
{
    public function __construct(
        private ProductId $id,
        private ProductSku $sku,
        private ProductCategory $category,
        private ProductName $name,
        private ProductPrice $price,
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

    public function price(): ProductPrice
    {
        return $this->price;
    }
}