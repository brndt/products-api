<?php

declare(strict_types=1);

namespace Ecommerce\Product\Infrastructure\Framework\Controller;

use Ecommerce\Product\Application\DTO\ProductCriteriaRequest;
use Ecommerce\Product\Application\SearchProductsByCriteria\SearchProductsByCriteriaApplicationService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

final class ProductsGetRestController extends AbstractFOSRestController
{
    public function __construct(private SearchProductsByCriteriaApplicationService $searchProductsByCriteria)
    {
    }

    #[Rest\Get('/products')]
    public function __invoke(Request $request): Response
    {
        $filters = [];
        $filteredByCategory = $request->query->get('category');
        if (null !== $filteredByCategory) {
            $filters[] = ['field' => 'category', 'operator' => '=', 'value' => $filteredByCategory];
        }
        $orderBy = null;
        $order = null;
        $limit = 10;
        $offset = 0;

        $response = ($this->searchProductsByCriteria)(
            new ProductCriteriaRequest($filters, $orderBy, $order, $limit, $offset)
        );

        return $this->handleView($this->view($response->items(), Response::HTTP_OK , []));
    }
}