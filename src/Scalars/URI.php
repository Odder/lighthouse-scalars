<?php

namespace Odder\LighthouseScalars\Scalars;

use GraphQL\Type\Definition\ScalarType;
use GraphQL\Error\Error;
use GraphQL\Language\AST\StringValueNode;

class URI extends ScalarType
{
    public ?string $description = <<<TXT
        The `URI` scalar type represents a Uniform Resource Identifier as specified by RFC 3986.
        This scalar type is designed to encompass all possible URI schemes.
        TXT;

    public function serialize($value): string
    {
        if (!$this->isValidUri($value)) {
            throw new Error("Cannot serialize value as URI: {$value}");
        }

        return $value;
    }

    public function parseValue($value): string
    {
        if (!$this->isValidUri($value)) {
            throw new Error("Cannot represent value as URI: {$value}");
        }

        return $value;
    }

    public function parseLiteral($valueNode, ?array $variables = null): string
    {
        if (!$valueNode instanceof StringValueNode) {
            throw new Error('Query error: Can only parse strings got: ' . $valueNode->kind, [$valueNode]);
        }

        if (!$this->isValidUri($valueNode->value)) {
            throw new Error("Not a valid URI: {$valueNode->value}");
        }

        return $valueNode->value;
    }

    protected function isValidUri($value): bool
    {
        return filter_var($value, FILTER_VALIDATE_URL) !== false;
    }
}