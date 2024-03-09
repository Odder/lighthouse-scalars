<?php

namespace Odder\LighthouseScalars\Core;

use GraphQL\Language\AST\StringValueNode;
use GraphQL\Error\Error;

class StringScalarType extends GenericScalarType
{
    protected string $supportedNodeType = StringValueNode::class;

    protected function coerce($value): mixed
    {
        if (is_string($value) || is_numeric($value) || $value instanceof \Stringable) {
            echo "StringScalarType::coerce: " . $value . "\n";
            return (string) $value;
        }

        throw new Error('Query error: Can only parse strings got: ' . $value->kind, [$value]);
    }
}