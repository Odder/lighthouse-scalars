<?php

namespace Odder\LighthouseScalars\Scalars;

use Odder\LighthouseScalars\Concerns\ValidatesLanguageCode;
use Odder\LighthouseScalars\Core\StringScalarType;

/**
 * The `LanguageCode` scalar type represents language codes as defined by ISO 639-1.
 * This scalar ensures that the input is a valid two-letter language code.
 */
class LanguageCode extends StringScalarType
{
    use ValidatesLanguageCode;

    public ?string $description = <<<TXT
        The `LanguageCode` scalar type represents language codes compliant with the ISO 639-1 standard. It validates that inputs are two-letter language codes within GraphQL queries and mutations.
        TXT;

    protected function coerce($value): string
    {
        $value = parent::coerce($value);
        return strtolower((string)$value);
    }

    protected function coerceOut($value): string
    {
        $value = parent::coerceOut($value);
        return strtolower((string)$value);
    }

    protected function isValid($value): bool
    {
        return $this->isValidLanguageCode($value);
    }
}
