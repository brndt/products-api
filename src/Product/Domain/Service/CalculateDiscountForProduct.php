<?php

declare(strict_types=1);

namespace Ecommerce\Product\Domain\Service;

use Ecommerce\Product\Domain\Product;
use Ecommerce\Product\Domain\ProductDiscountPercentage;
use Ecommerce\ProductCategoryDiscount\Domain\Service\SearchProductDiscountByCategory;
use Ecommerce\ProductSkuDiscount\Domain\Service\SearchProductDiscountBySku;

final class CalculateDiscountForProduct
{
    public function __construct(
        private SearchProductDiscountBySku $searchProductDiscountBySku,
        private SearchProductDiscountByCategory $searchProductDiscountByCategory,
    ) {
    }

    public function __invoke(Product $product): ProductDiscountPercentage
    {
        $discountByCategory = ($this->searchProductDiscountByCategory)($product->category());

        $discountBySku = ($this->searchProductDiscountBySku)($product->sku());

        return ProductDiscountPercentage::max($discountByCategory, $discountBySku);
    }
}