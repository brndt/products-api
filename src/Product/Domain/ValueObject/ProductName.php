<?php

declare(strict_types=1);

namespace Ecommerce\Product\Domain\ValueObject;

final class ProductName
{
    public function __construct(public readonly string $value)
    {
    }
}