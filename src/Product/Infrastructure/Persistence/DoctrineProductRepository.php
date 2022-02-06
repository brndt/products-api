<?php

declare(strict_types=1);

namespace Ecommerce\Product\Infrastructure\Persistence;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Ecommerce\Common\Domain\Criteria\Criteria;
use Ecommerce\Common\Infrastructure\Doctrine\DoctrineCriteriaConverter;
use Ecommerce\Product\Domain\Product;
use Ecommerce\Product\Domain\Repository\ProductRepository;

final class DoctrineProductRepository implements ProductRepository
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function ofCriteria(Criteria $criteria): array
    {
        $doctrineCriteria = DoctrineCriteriaConverter::convert($criteria);

        return $this->repository()->matching($doctrineCriteria)->toArray();
    }

    private function repository(): EntityRepository
    {
        return $this->entityManager->getRepository(Product::class);
    }
}