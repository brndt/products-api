<?php

declare(strict_types=1);

namespace Ecommerce\ProductSkuDiscount\Infrastructure\Persistence;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Ecommerce\Product\Domain\ProductSku;
use Ecommerce\ProductSkuDiscount\Domain\ProductSkuDiscount;
use Ecommerce\ProductSkuDiscount\Domain\ProductSkuDiscountId;
use Ecommerce\ProductSkuDiscount\Domain\Repository\ProductSkuDiscountRepository;

final class DoctrineProductSkuDiscountRepository implements ProductSkuDiscountRepository
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function ofId(ProductSkuDiscountId $id): ProductSkuDiscount
    {
        return $this->repository()->find($id);
    }

    private function repository(): EntityRepository
    {
        return $this->entityManager->getRepository(ProductSkuDiscount::class);
    }

    public function bySku(ProductSku $sku): ?ProductSkuDiscount
    {
        return $this->repository()->findOneBy(['sku' => $sku]);
    }
}