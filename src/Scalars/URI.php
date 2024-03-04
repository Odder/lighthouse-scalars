<?php

namespace Odder\LighthouseScalars\Scalars;

use GraphQL\Language\AST\StringValueNode;
use Odder\LighthouseScalars\Core\GenericScalarType;

class URI extends GenericScalarType
{
    protected string $supportedNodeType = StringValueNode::class;

    public ?string $description = <<<TXT
        The `URI` scalar type represents a Uniform Resource Identifier as specified by RFC 3986.
        This scalar type is designed to encompass all possible URI schemes.
        TXT;

    protected function isValid($value): bool
    {
        return filter_var($value, FILTER_VALIDATE_URL) !== false;
    }
}