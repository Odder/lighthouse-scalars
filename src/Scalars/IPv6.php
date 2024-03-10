<?php

namespace Odder\LighthouseScalars\Scalars;

use Odder\LighthouseScalars\Core\StringScalarType;

class IPv6 extends StringScalarType
{
    public ?string $description = <<<TXT
        The `IPv6` scalar type represents IPv6 address strings.
        TXT;

    protected function isValid($value): bool
    {
        return filter_var($value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) !== false;
    }
}