<?php

declare(strict_types=1);

namespace Ecommerce\Product\Application\DTO;

use Ecommerce\Product\Domain\ProductCalculatedDiscount;

final class ProductWithCalculatedDiscountResponse
{
    public function __construct(
        public readonly string $id,
        public readonly int $sku,
        public readonly string $category,
        public readonly string $name,
        public readonly ProductCalculatedDiscountResponse $price,
    ) {
    }
}