<?php

declare(strict_types=1);

namespace Ecommerce\Product\Application\SearchProductsByCriteria;

use Ecommerce\Common\Domain\Criteria\Criteria;
use Ecommerce\Common\Domain\Criteria\Filters;
use Ecommerce\Common\Domain\Criteria\Order;
use Ecommerce\Product\Application\DTO\ProductCriteriaRequest;
use Ecommerce\Product\Application\DTO\ProductResponse;
use Ecommerce\Product\Application\DTO\ProductResponseCollection;
use Ecommerce\Product\Domain\Aggregate\Product;
use Ecommerce\Product\Domain\Repository\ProductRepository;

use function Lambdish\Phunctional\map;

final class SearchProductsByCriteriaApplicationService
{
    public function __construct(private ProductRepository $repository)
    {
    }

    public function __invoke(ProductCriteriaRequest $request): ProductResponseCollection
    {
        $filters = Filters::fromPrimitives($request->filters);
        $order = Order::fromValues($request->orderBy, $request->order);
        $limit = $request->limit;
        $offset = $request->offset;

        $criteria = new Criteria($filters, $order, $limit, $offset);

        $products = $this->repository->ofCriteria($criteria);

        return $this->toResponse(...$products);
    }

    private function toResponse(Product ...$products): ProductResponseCollection
    {
        return new ProductResponseCollection(
            map(
                static fn(Product $product) => new ProductResponse(
                    $product->id()->value,
                    $product->sku()->value,
                    $product->category()->value,
                    $product->name()->value,
                    $product->price()->value
                ),
                $products
            )
        );
    }
}