<?php

declare(strict_types=1);

namespace Ecommerce\Product\Application\DTO;

final class ProductCriteriaRequest
{
    public function __construct(
        public readonly array $filters,
        public readonly ?string $orderBy,
        public readonly ?string $order,
        public readonly int $limit,
        public readonly int $offset,
    ) {
    }
}