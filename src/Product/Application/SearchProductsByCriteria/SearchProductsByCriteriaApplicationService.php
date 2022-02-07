<?php

declare(strict_types=1);

namespace Ecommerce\Product\Application\SearchProductsByCriteria;

use Ecommerce\Common\Domain\Criteria\Criteria;
use Ecommerce\Common\Domain\Criteria\Filters;
use Ecommerce\Common\Domain\Criteria\Order;
use Ecommerce\Product\Application\DTO\ProductCriteriaRequest;
use Ecommerce\Product\Application\DTO\ProductCalculatedDiscountResponse;
use Ecommerce\Product\Application\DTO\ProductWithCalculatedDiscountResponse;
use Ecommerce\Product\Application\DTO\ProductResponseCollection;
use Ecommerce\Product\Domain\Product;
use Ecommerce\Product\Domain\ProductPriceCurrency;
use Ecommerce\Product\Domain\ProductCalculatedDiscount;
use Ecommerce\Product\Domain\ProductWithCalculatedDiscount;
use Ecommerce\Product\Domain\Repository\ProductRepository;

use Ecommerce\Product\Domain\Service\CalculateDiscountForProduct;

use function Lambdish\Phunctional\map;

final class SearchProductsByCriteriaApplicationService
{
    public function __construct(
        private ProductRepository $repository,
        private CalculateDiscountForProduct $calculateDiscountForProduct,
    ) {
    }

    public function __invoke(ProductCriteriaRequest $request): ProductResponseCollection
    {
        $filters = Filters::fromPrimitives($request->filters);
        $order = Order::fromValues($request->orderBy, $request->order);
        $limit = $request->limit;
        $offset = $request->offset;

        $criteria = new Criteria($filters, $order, $limit, $offset);

        $products = $this->repository->ofCriteria($criteria);

        return $this->toResponse(...$this->productsWithCalculatedDiscount($products));
    }

    private function toResponse(ProductWithCalculatedDiscount ...$products): ProductResponseCollection
    {
        return new ProductResponseCollection(
            map(
                fn(ProductWithCalculatedDiscount $product) => new ProductWithCalculatedDiscountResponse(
                    $product->id()->value,
                    $product->sku()->value,
                    $product->category()->value,
                    $product->name()->value,
                    ProductCalculatedDiscountResponse::fromCalculatedDiscount($product->calculatedDiscount()),
                ),
                $products
            )
        );
    }

    private function productsWithCalculatedDiscount(array $products): array
    {
        return map(
            fn(Product $product) => new ProductWithCalculatedDiscount(
                $product->id(),
                $product->sku(),
                $product->category(),
                $product->name(),
                $this->extractProductCalculatedDiscount($product)
            ),
            $products
        );
    }

    private function extractProductCalculatedDiscount(Product $product): ProductCalculatedDiscount
    {
        $discount = ($this->calculateDiscountForProduct)($product);

        return new ProductCalculatedDiscount(
            $product->price(),
            $product->price()->withDiscount($discount),
            $discount,
            ProductPriceCurrency::EUR,
        );
    }
}