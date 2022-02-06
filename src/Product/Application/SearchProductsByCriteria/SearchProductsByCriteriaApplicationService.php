<?php

declare(strict_types=1);

namespace Ecommerce\Product\Application\SearchProductsByCriteria;

use Ecommerce\Common\Domain\Criteria\Criteria;
use Ecommerce\Common\Domain\Criteria\Filters;
use Ecommerce\Common\Domain\Criteria\Order;
use Ecommerce\Product\Application\DTO\ProductCriteriaRequest;
use Ecommerce\Product\Application\DTO\ProductPriceResponse;
use Ecommerce\Product\Application\DTO\ProductResponse;
use Ecommerce\Product\Application\DTO\ProductResponseCollection;
use Ecommerce\Product\Domain\Product;
use Ecommerce\Product\Domain\ProductPriceCurrency;
use Ecommerce\Product\Domain\ProductPriceVO;
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

        return $this->toResponse(...$products);
    }

    private function toResponse(Product ...$products): ProductResponseCollection
    {
        return new ProductResponseCollection(
            map(
                fn(Product $product) => new ProductResponse(
                    $product->id()->value,
                    $product->sku()->value,
                    $product->category()->value,
                    $product->name()->value,
                    ProductPriceResponse::fromProductPrice($this->productPriceWithDiscount($product))
                ),
                $products
            )
        );
    }

    private function productPriceWithDiscount(Product $product): ProductPriceVO
    {
        $discount = ($this->calculateDiscountForProduct)($product);

        return new ProductPriceVO(
            $product->price(),
            $product->price()->withDiscount($discount),
            $discount,
            ProductPriceCurrency::EUR,
        );
    }
}