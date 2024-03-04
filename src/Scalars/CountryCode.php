<?php

namespace Odder\LighthouseScalars\Scalars;

use Odder\LighthouseScalars\Concerns\ValidatesCountryCode;
use Odder\LighthouseScalars\Core\GenericScalarType;

class CountryCode extends GenericScalarType
{
    use ValidatesCountryCode;

    public ?string $description = <<<TXT
        The `CountryCode` scalar type represents country codes as specified by ISO 3166-1 alpha-2.
        TXT;

    protected function coerce($value): string
    {
        return strtoupper($value);
    }

    protected function isValid($value): bool
    {
        return $this->isValidCountryCode($value);
    }
}