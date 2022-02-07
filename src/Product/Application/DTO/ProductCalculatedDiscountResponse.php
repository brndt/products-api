<?php

declare(strict_types=1);

namespace Ecommerce\Product\Application\DTO;

use Ecommerce\Product\Domain\ProductCalculatedDiscount;

final class ProductCalculatedDiscountResponse
{
    public function __construct(
        public readonly int $originalPrice,
        public readonly int $finalPrice,
        public readonly string $discountPercentage,
        public readonly string $currency,
    ) {
    }

    public static function fromCalculatedDiscount(ProductCalculatedDiscount $productCalculatedDiscount)
    {
        return new self(
            $productCalculatedDiscount->originalPrice()->value,
            $productCalculatedDiscount->finalPrice()->value,
            $productCalculatedDiscount->discountPercentage()->asString(),
            $productCalculatedDiscount->currency()->value
        );
    }
}