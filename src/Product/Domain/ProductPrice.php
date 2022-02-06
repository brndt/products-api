<?php

declare(strict_types=1);

namespace Ecommerce\Product\Domain;

final class ProductPrice
{
    public function __construct(public readonly int $value)
    {
    }
}