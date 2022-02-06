<?php

declare(strict_types=1);

namespace Ecommerce\ProductCategoryDiscount\Domain;

use Ecommerce\Product\Domain\ProductDiscountPercentage;
use Ecommerce\Product\Domain\ProductCategory;

final class ProductCategoryDiscount
{
    public function __construct(
        private ProductCategoryDiscountId $id,
        private ProductCategory $category,
        private ProductDiscountPercentage $discountPercentage,
    ) {
    }

    public function id(): ProductCategoryDiscountId
    {
        return $this->id;
    }

    public function category(): ProductCategory
    {
        return $this->category;
    }

    public function discountPercentage(): ProductDiscountPercentage
    {
        return $this->discountPercentage;
    }
}