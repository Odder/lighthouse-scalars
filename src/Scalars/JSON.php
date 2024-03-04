<?php

namespace Odder\LighthouseScalars\Scalars;

use Odder\LighthouseScalars\Core\GenericScalarType;

class JSON extends GenericScalarType
{
    public ?string $description = <<<TXT
        The `JSON` scalar type represents JSON values as specified by ECMA-404.
        TXT;

    protected function coerce($value): mixed
    {
        return json_decode($value, true);
    }

    protected function coerceOut($value): string
    {
        return json_encode($value);
    }

    protected function isValid($value): bool
    {
        return json_last_error() === JSON_ERROR_NONE;
    }
}
