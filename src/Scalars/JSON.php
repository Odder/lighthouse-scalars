<?php

namespace Odder\LighthouseScalars\Scalars;

use GraphQL\Type\Definition\ScalarType;
use GraphQL\Error\Error;
use GraphQL\Language\AST\StringValueNode;

class JSON extends ScalarType
{
    public $description = <<<TXT
        The `JSON` scalar type represents JSON values as specified by ECMA-404.
        TXT;

    public function serialize($value): string
    {
        // Attempt to encode the value into JSON. This also serves as a validation step.
        $json = json_encode($value);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Error('Cannot serialize value to JSON: ' . json_last_error_msg());
        }

        return $json;
    }

    public function parseValue($value): mixed
    {
        // Attempt to decode the JSON value. This also serves as a validation step.
        $decoded = json_decode($value, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Error('Cannot represent value as JSON: ' . json_last_error_msg());
        }

        return $decoded;
    }

    public function parseLiteral($valueNode, ?array $variables = null): mixed
    {
        // We expect the valueNode to be of type StringValueNode for JSON encoded as a string.
        if (!$valueNode instanceof StringValueNode) {
            throw new Error('Query error: Can only parse strings got: ' . $valueNode->kind, [$valueNode]);
        }

        return $this->parseValue($valueNode->value);
    }
}
