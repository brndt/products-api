<?php

declare(strict_types=1);

namespace Ecommerce\ProductCategoryDiscount\Infrastructure\Persistence\Mapping;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;
use Ecommerce\ProductCategoryDiscount\Domain\ProductCategoryDiscountId;

final class ProductCategoryDiscountIdType extends GuidType
{
    public function convertToPHPValue($value, AbstractPlatform $platform): mixed
    {
        return new ProductCategoryDiscountId($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): mixed
    {
        return $value->value;
    }
}