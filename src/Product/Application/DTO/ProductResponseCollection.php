<?php

declare(strict_types=1);

namespace Ecommerce\Product\Application\DTO;

use Ecommerce\Common\Domain\Collection;

use function Lambdish\Phunctional\map;

final class ProductResponseCollection extends Collection
{
    public static function type(): string
    {
        return ProductWithCalculatedDiscountResponse::class;
    }

    public static function fromPrimitives(array $primitives): static
    {
        $itemType = static::type();

        return new static(map(static fn (mixed $item) => new $itemType($item), $primitives));
    }

    public function toPrimitives(): array
    {
        return map(fn (mixed $item): mixed => $item->value(), $this);
    }
}