<?php

namespace Odder\LighthouseScalars\Scalars;

use GraphQL\Language\AST\StringValueNode;
use Odder\LighthouseScalars\Core\StringScalarType;

class UUID extends StringScalarType
{
    public ?string $description = <<<TXT
        The `UUID` scalar type represents a Universally Unique Identifier as defined by RFC 4122.
        TXT;
    protected string $supportedNodeType = StringValueNode::class;

    protected function isValid($value): bool
    {
        return preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-[1-5][0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/i', $value) > 0;
    }
}
