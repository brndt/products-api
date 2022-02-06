<?php

declare(strict_types=1);

namespace Ecommerce\ProductSkuDiscount\Domain;

use Ecommerce\Product\Domain\ProductCategory;
use Ecommerce\Product\Domain\ProductDiscountPercentage;
use Ecommerce\Product\Domain\ProductSku;

final class ProductSkuDiscount
{
    public function __construct(
        private ProductSkuDiscountId $id,
        private ProductSku $sku,
        private ProductDiscountPercentage $discountPercentage,
    ) {
    }

    public function id(): ProductSkuDiscountId
    {
        return $this->id;
    }

    public function sku(): ProductSku
    {
        return $this->sku;
    }

    public function discountPercentage(): ProductDiscountPercentage
    {
        return $this->discountPercentage;
    }
}