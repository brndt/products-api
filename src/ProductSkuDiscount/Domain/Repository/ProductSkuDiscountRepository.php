<?php

declare(strict_types=1);

namespace Ecommerce\ProductSkuDiscount\Domain\Repository;

use Ecommerce\ProductSkuDiscount\Domain\ProductSkuDiscount;
use Ecommerce\ProductSkuDiscount\Domain\ProductSkuDiscountId;

interface ProductSkuDiscountRepository
{
    public function ofId(ProductSkuDiscountId $id): ProductSkuDiscount;
}