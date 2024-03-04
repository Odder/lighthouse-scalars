<?php

namespace Odder\LighthouseScalars\Scalars;

use Odder\LighthouseScalars\Core\GenericScalarType;

/**
 * The `Email` scalar type represents email addresses compliant to the RFC 5321 specification.
 * This scalar ensures that the input is a valid email address format.
 */
class Email extends GenericScalarType
{
    public ?string $description = <<<TXT
        The `Email` scalar type represents email addresses, ensuring inputs are compliant with the RFC 5321 specification. It is designed to validate email address formats within GraphQL queries and mutations.
        TXT;

    protected function isValid($value): bool
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
    }
}