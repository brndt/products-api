<?php

declare(strict_types=1);

namespace Ecommerce\Product\Infrastructure\Framework\Controller;

use Ecommerce\Product\Application\DTO\ProductCriteriaRequest;
use Ecommerce\Product\Application\SearchProductsByCriteria\SearchProductsByCriteriaApplicationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class ProductsGetRestController extends AbstractController
{
    public function __construct(private SearchProductsByCriteriaApplicationService $searchProductsByCriteria)
    {
    }

    #[Route('/products')]
    public function __invoke(): Response
    {
        $filters = [];
        $orderBy = null;
        $order = null;
        $limit = 10;
        $offset = 0;

        $response = ($this->searchProductsByCriteria)(
            new ProductCriteriaRequest($filters, $orderBy, $order, $limit, $offset)
        );

        return new JsonResponse($response->items());
    }
}