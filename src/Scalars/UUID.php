<?php

namespace Odder\LighthouseScalars\Scalars;

use GraphQL\Type\Definition\ScalarType;
use GraphQL\Error\Error;
use GraphQL\Language\AST\StringValueNode;

class UUID extends ScalarType
{
    public ?string $description = <<<TXT
        The `UUID` scalar type represents a Universally Unique Identifier as defined by RFC 4122.
        TXT;

    public function serialize($value): string
    {
        if (!$this->isValidUUID($value)) {
            throw new Error("Cannot serialize value as UUID: {$value}");
        }

        return $value;
    }

    public function parseValue($value): string
    {
        if (!$this->isValidUUID($value)) {
            throw new Error("Cannot represent value as UUID: {$value}");
        }

        return $value;
    }

    public function parseLiteral($valueNode, ?array $variables = null): string
    {
        if (!$valueNode instanceof StringValueNode) {
            throw new Error('Query error: Can only parse strings got: ' . $valueNode->kind, [$valueNode]);
        }

        if (!$this->isValidUUID($valueNode->value)) {
            throw new Error("Not a valid UUID: {$valueNode->value}");
        }

        return $valueNode->value;
    }

    protected function isValidUUID($value): bool
    {
        return preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-[1-5][0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/i', $value) > 0;
    }
}
