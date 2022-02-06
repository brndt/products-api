<?php

declare(strict_types=1);

namespace Ecommerce\Product\Domain\ValueObject;

final class ProductSku
{
    public function __construct(public readonly int $value)
    {
    }
}