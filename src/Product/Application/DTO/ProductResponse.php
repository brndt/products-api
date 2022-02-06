<?php

declare(strict_types=1);

namespace Ecommerce\Product\Application\DTO;

final class ProductResponse
{
    public function __construct(
        public readonly string $id,
        public readonly int $sku,
        public readonly string $category,
        public readonly string $name,
        public readonly ProductPriceResponse $price,
    ) {
    }
}