<?php

declare(strict_types=1);

namespace Ecommerce\Product\Domain;

enum ProductCategory: string
{
    case Boots = 'boots';
    case Sandals = 'sandals';
    case Sneakers = 'sneakers';
}