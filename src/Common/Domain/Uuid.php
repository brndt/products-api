<?php

declare(strict_types=1);

namespace Ecommerce\Common\Domain;

use InvalidArgumentException;
use Ramsey\Uuid\Uuid as RamseyUuid;

abstract class Uuid
{
    public function __construct(public readonly string $value)
    {
        $this->ensureIsValidUuid($this->value);
    }

    public static function random(): static
    {
        return new static(RamseyUuid::uuid4()->toString());
    }

    private function ensureIsValidUuid(string $value): void
    {
        if (! RamseyUuid::isValid($value)) {
            throw new InvalidArgumentException($value);
        }
    }
}