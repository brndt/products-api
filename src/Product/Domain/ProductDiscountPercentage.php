<?php

declare(strict_types=1);

namespace Ecommerce\Product\Domain;

final class ProductDiscountPercentage
{
    public function __construct(public readonly int $value)
    {
    }

    public function asString(): string
    {
        return $this->value . '%';
    }
}