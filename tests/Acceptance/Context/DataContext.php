<?php

declare(strict_types=1);

namespace Ecommerce\Tests\Acceptance\Context;

use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\RawMinkContext;

use Doctrine\ORM\EntityManagerInterface;
use Ecommerce\Product\Domain\Product;

use Ecommerce\Product\Domain\ProductCategory;
use Ecommerce\Product\Domain\ProductDiscountPercentage;
use Ecommerce\Product\Domain\ProductId;

use Ecommerce\Product\Domain\ProductName;
use Ecommerce\Product\Domain\ProductPrice;
use Ecommerce\Product\Domain\ProductSku;

use Ecommerce\ProductCategoryDiscount\Domain\ProductCategoryDiscount;

use Ecommerce\ProductCategoryDiscount\Domain\ProductCategoryDiscountId;

use Ecommerce\ProductSkuDiscount\Domain\ProductSkuDiscount;

use Ecommerce\ProductSkuDiscount\Domain\ProductSkuDiscountId;

use function Lambdish\Phunctional\each;

final class DataContext extends RawMinkContext
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    /**
     * @Given there are products with the following details:
     */
    public function thereAreProductsWithTheFollowingDetails(TableNode $products): void
    {
        each(
            function (array $product) {
                $aggregate = new Product(
                    new ProductId($product['id']),
                    new ProductSku($product['sku']),
                    ProductCategory::from($product['category']),
                    new ProductName($product['name']),
                    new ProductPrice((int) $product['price']),
                );
                $this->entityManager->persist($aggregate);
                $this->entityManager->flush();
            },
            $products
        );
    }

    /**
     * @Given there are product discounts by category with the following details:
     */
    public function thereAreProductDiscountsByCategoryWithTheFollowingDetails(TableNode $productCategoryDiscounts): void
    {
        each(
            function (array $productCategoryDiscount) {
                $aggregate = new ProductCategoryDiscount(
                    new ProductCategoryDiscountId($productCategoryDiscount['id']),
                    ProductCategory::from($productCategoryDiscount['category']),
                    new ProductDiscountPercentage((int) $productCategoryDiscount['discount_percentage']),
                );
                $this->entityManager->persist($aggregate);
                $this->entityManager->flush();
            },
            $productCategoryDiscounts
        );
    }

    /**
     * @Given there are product discounts by sku with the following details:
     */
    public function thereAreProductDiscountsBySkuWithTheFollowingDetails(TableNode $productSkuDiscounts): void
    {
        each(
            function (array $productSkuDiscount) {
                $aggregate = new ProductSkuDiscount(
                    new ProductSkuDiscountId($productSkuDiscount['id']),
                    new ProductSku($productSkuDiscount['sku']),
                    new ProductDiscountPercentage((int) $productSkuDiscount['discount_percentage']),
                );
                $this->entityManager->persist($aggregate);
                $this->entityManager->flush();
            },
            $productSkuDiscounts
        );
    }
}