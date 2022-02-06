<?php

declare(strict_types=1);

namespace Ecommerce\ProductCategoryDiscount\Domain\Repository;

use Ecommerce\Product\Domain\ProductCategory;
use Ecommerce\ProductCategoryDiscount\Domain\ProductCategoryDiscount;
use Ecommerce\ProductCategoryDiscount\Domain\ProductCategoryDiscountId;

interface ProductCategoryDiscountRepository
{
    public function ofId(ProductCategoryDiscountId $id): ?ProductCategoryDiscount;

    public function byCategory(ProductCategory $category): ?ProductCategoryDiscount;
}