<?php

declare(strict_types=1);

namespace Ecommerce\Product\Domain;

final class ProductPrice
{
    public function __construct(public readonly int $value)
    {
    }

    public function withDiscount(ProductDiscountPercentage $discountPercentage): self
    {
        return new self($this->value - $this->value * $discountPercentage->value);
    }
}