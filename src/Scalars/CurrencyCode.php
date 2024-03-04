<?php

namespace Odder\LighthouseScalars\Scalars;

use Odder\LighthouseScalars\Concerns\ValidatesCurrencyCode;
use Odder\LighthouseScalars\Core\GenericScalarType;

class CurrencyCode extends GenericScalarType
{
    use ValidatesCurrencyCode;

    public ?string $description = <<<TXT
        The `CurrencyCode` scalar type represents currency codes as specified by ISO 4217.
        TXT;

    protected function coerce($value): string
    {
        return strtoupper($value);
    }

    protected function isValid($value): bool
    {
        return $this->isValidCurrencyCode($value);
    }
}