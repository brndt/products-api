<?php

declare(strict_types=1);

namespace Ecommerce\Product\Domain;

final class ProductName
{
    public function __construct(public readonly string $value)
    {
    }
}