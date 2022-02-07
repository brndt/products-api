<?php

declare(strict_types=1);

namespace Ecommerce\Product\Infrastructure\Persistence\Mapping;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use Ecommerce\Product\Domain\ProductSku;

final class ProductSkuType extends StringType
{
    public function convertToPHPValue($value, AbstractPlatform $platform): mixed
    {
        return new ProductSku($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): mixed
    {
        return $value->value;
    }
}