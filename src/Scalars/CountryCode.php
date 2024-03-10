<?php

namespace Odder\LighthouseScalars\Scalars;

use Odder\LighthouseScalars\Concerns\ValidatesCountryCode;
use Odder\LighthouseScalars\Core\StringScalarType;

class CountryCode extends StringScalarType
{
    use ValidatesCountryCode;

    public ?string $description = <<<TXT
        The `CountryCode` scalar type represents country codes as specified by ISO 3166-1 alpha-2.
        TXT;

    protected function coerce($value): string
    {
        $value = parent::coerce($value);
        return strtoupper($value);
    }

    protected function isValid($value): bool
    {
        return $this->isValidCountryCode($value);
    }
}