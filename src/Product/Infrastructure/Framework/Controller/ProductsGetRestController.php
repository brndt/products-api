<?php

declare(strict_types=1);

namespace Ecommerce\Product\Infrastructure\Framework\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class ProductsGetRestController
{
    /**
     * @Route("/health-check")
     */
    public function number(): Response
    {
        return new Response('OK');
    }
}