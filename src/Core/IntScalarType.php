<?php

namespace Odder\LighthouseScalars\Core;

use GraphQL\Error\Error;
use GraphQL\Language\AST\IntValueNode;

class IntScalarType extends GenericScalarType
{
    protected string $supportedNodeType = IntValueNode::class;

    protected function coerce($value): int
    {
        if (is_numeric($value)) {
            return (int) $value;
        }

        throw new Error('Query error: Can only parse ints got: ' . $value->kind, [$value]);
    }
}