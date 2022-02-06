<?php

declare(strict_types=1);

namespace Ecommerce\Product\Infrastructure\Persistence\Mapping;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use Ecommerce\Product\Domain\ProductCategory;

final class ProductCategoryType extends StringType
{
    public function convertToPHPValue($value, AbstractPlatform $platform): mixed
    {
        return ProductCategory::from($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): mixed
    {
        return $value->value;
    }
}