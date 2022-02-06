<?php

declare(strict_types=1);

namespace Ecommerce\Product\Domain;

final class ProductPriceVO
{
    public function __construct(
        private ProductPrice $originalPrice,
        private ProductPrice $finalPrice,
        private ProductDiscountPercentage $discountPercentage,
        private ProductPriceCurrency $currency,
    ) {
    }

    public function originalPrice(): ProductPrice
    {
        return $this->originalPrice;
    }

    public function finalPrice(): ProductPrice
    {
        return $this->finalPrice;
    }

    public function discountPercentage(): ProductDiscountPercentage
    {
        return $this->discountPercentage;
    }

    public function currency(): ProductPriceCurrency
    {
        return $this->currency;
    }
}