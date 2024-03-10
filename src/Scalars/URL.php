<?php

namespace Odder\LighthouseScalars\Scalars;

use Odder\LighthouseScalars\Core\StringScalarType;

class URL extends StringScalarType
{
    public ?string $description = <<<TXT
        The `URL` scalar type represents a valid URL as specified by RFC 3986.
        Only URLs with "http" or "https" schemes are considered valid.
        TXT;

    protected function isValid($value): bool
    {
        $parts = parse_url($value);
        return $parts !== false &&
            isset($parts['scheme']) &&
            in_array(strtolower($parts['scheme']), ['http', 'https'], true) &&
            isset($parts['host']);
    }
}