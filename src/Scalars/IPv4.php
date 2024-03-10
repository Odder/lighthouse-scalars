<?php

namespace Odder\LighthouseScalars\Scalars;

use Odder\LighthouseScalars\Core\StringScalarType;

class IPv4 extends StringScalarType
{
    public ?string $description = <<<TXT
        The `IPv4` scalar type represents IPv4 addresses as specified by RFC 791.
        TXT;

    protected function isValid($value): bool
    {
        return filter_var($value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) !== false;
    }
}