<?php

declare(strict_types=1);

namespace Ecommerce\ProductCategoryDiscount\Domain\Service;

use Ecommerce\Product\Domain\ProductCategory;
use Ecommerce\Product\Domain\ProductDiscountPercentage;
use Ecommerce\ProductCategoryDiscount\Domain\ProductCategoryDiscount;
use Ecommerce\ProductCategoryDiscount\Domain\Repository\ProductCategoryDiscountRepository;

final class SearchProductDiscountByCategory
{
    public function __construct(private ProductCategoryDiscountRepository $repository)
    {
    }

    public function __invoke(ProductCategory $category): ProductDiscountPercentage
    {
        $productCategoryDiscount = $this->repository->byCategory($category);

        if (null === $productCategoryDiscount) {
            return ProductDiscountPercentage::zero();
        }

        return $productCategoryDiscount->discountPercentage();
    }
}