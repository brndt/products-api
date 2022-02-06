<?php

declare(strict_types=1);

namespace Ecommerce\Product\Domain\Repository;

use Ecommerce\Common\Domain\Criteria\Criteria;

interface ProductRepository
{
    public function ofCriteria(Criteria $criteria): array;
}