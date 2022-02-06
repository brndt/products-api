<?php

declare(strict_types=1);

namespace Ecommerce\ProductSkuDiscount\Infrastructure\Persistence\Mapping;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;
use Ecommerce\ProductSkuDiscount\Domain\ProductSkuDiscountId;

final class ProductSkuDiscountIdType extends GuidType
{
    public function convertToPHPValue($value, AbstractPlatform $platform): mixed
    {
        return new ProductSkuDiscountId($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): mixed
    {
        return $value->value;
    }
}