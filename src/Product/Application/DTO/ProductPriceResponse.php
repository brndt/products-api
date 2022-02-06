<?php

declare(strict_types=1);

namespace Ecommerce\Product\Application\DTO;

use Ecommerce\Product\Domain\ProductPriceVO;

final class ProductPriceResponse
{
    public function __construct(
        public readonly int $originalPrice,
        public readonly int $finalPrice,
        public readonly string $discountPercentage,
        public readonly string $currency,
    ) {
    }

    public static function fromProductPrice(ProductPriceVO $productPrice)
    {
        return new self(
            $productPrice->originalPrice()->value,
            $productPrice->finalPrice()->value,
            $productPrice->discountPercentage()->asString(),
            $productPrice->currency()->value
        );
    }
}