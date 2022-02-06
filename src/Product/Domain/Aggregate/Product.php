<?php

declare(strict_types=1);

namespace Ecommerce\Product\Domain\Aggregate;

use Ecommerce\Product\Domain\ValueObject\ProductCategory;
use Ecommerce\Product\Domain\ValueObject\ProductId;
use Ecommerce\Product\Domain\ValueObject\ProductName;
use Ecommerce\Product\Domain\ValueObject\ProductPrice;
use Ecommerce\Product\Domain\ValueObject\ProductSku;

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