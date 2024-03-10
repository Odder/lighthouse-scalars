<?php

namespace Odder\LighthouseScalars\Core;

use GraphQL\Error\Error;
use GraphQL\Language\AST\FloatValueNode;
use GraphQL\Language\AST\StringValueNode;

class FloatScalarType extends GenericScalarType
{
    protected string $supportedNodeType = FloatValueNode::class;

    protected function coerce($value): float
    {
        if (is_numeric($value)) {
            return (float) $value;
        }

        throw new Error('Query error: Can only parse strings got: ' . $value->kind, [$value]);
    }
}