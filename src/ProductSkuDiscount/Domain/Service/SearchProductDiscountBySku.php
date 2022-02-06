<?php

declare(strict_types=1);

namespace Ecommerce\ProductSkuDiscount\Domain\Service;

use Ecommerce\Product\Domain\ProductDiscountPercentage;
use Ecommerce\Product\Domain\ProductSku;
use Ecommerce\ProductSkuDiscount\Domain\Repository\ProductSkuDiscountRepository;

final class SearchProductDiscountBySku
{
    public function __construct(private ProductSkuDiscountRepository $repository)
    {
    }

    public function __invoke(ProductSku $sku): ProductDiscountPercentage
    {
        $productSkuDiscount = $this->repository->bySku($sku);

        if (null === $productSkuDiscount) {
            return ProductDiscountPercentage::zero();
        }

        return $productSkuDiscount->discountPercentage();
    }
}