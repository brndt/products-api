<?php

declare(strict_types=1);

namespace Ecommerce\Product\Infrastructure\Persistence\Mapping;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;
use Ecommerce\Product\Domain\ProductId;

final class ProductIdType extends GuidType
{
    public function convertToPHPValue($value, AbstractPlatform $platform): mixed
    {
        return new ProductId($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): mixed
    {
        return $value->value;
    }
}