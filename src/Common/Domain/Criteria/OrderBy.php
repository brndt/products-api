<?php

declare(strict_types=1);

namespace Ecommerce\Common\Domain\Criteria;

final class OrderBy
{
    public function __construct(public readonly string $value)
    {
    }
}
