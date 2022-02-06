<?php

declare(strict_types=1);

namespace Ecommerce\Product\Domain;

final class ProductDiscountPercentage
{
    public function __construct(public readonly int $value)
    {
    }

    public static function zero(): self
    {
        return new self(0);
    }

    public static function max(ProductDiscountPercentage $discount, ProductDiscountPercentage $otherDiscount): self
    {
        return new self(max($discount->value, $otherDiscount->value));
    }

    public function asString(): string
    {
        return $this->value . '%';
    }
}