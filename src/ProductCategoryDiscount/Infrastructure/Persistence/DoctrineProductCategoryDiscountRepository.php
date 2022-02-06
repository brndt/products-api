<?php

declare(strict_types=1);

namespace Ecommerce\ProductCategoryDiscount\Infrastructure\Persistence;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Ecommerce\ProductCategoryDiscount\Domain\ProductCategoryDiscount;
use Ecommerce\ProductCategoryDiscount\Domain\ProductCategoryDiscountId;
use Ecommerce\ProductCategoryDiscount\Domain\Repository\ProductCategoryDiscountRepository;

final class DoctrineProductCategoryDiscountRepository implements ProductCategoryDiscountRepository
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function ofId(ProductCategoryDiscountId $id): ?ProductCategoryDiscount
    {
        return $this->repository()->find($id);
    }

    private function repository(): EntityRepository
    {
        return $this->entityManager->getRepository(ProductCategoryDiscount::class);
    }
}