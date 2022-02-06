<?php

declare(strict_types=1);

namespace Ecommerce\Product\Infrastructure\Persistence;

use Ecommerce\Common\Domain\Criteria\Criteria;
use Ecommerce\Product\Domain\Repository\ProductRepository;

final class DoctrineProductRepository implements ProductRepository
{
    public function ofCriteria(Criteria $criteria): array
    {
        return [];
    }
}