<?php

namespace Odder\LighthouseScalars\Scalars;

use GraphQL\Type\Definition\ScalarType;
use GraphQL\Error\Error;
use GraphQL\Language\AST\StringValueNode;

class IPv6 extends ScalarType
{
    public ?string $description = <<<TXT
        The `IPv6` scalar type represents IPv6 address strings.
        TXT;

    public function serialize($value): string
    {
        if (!$this->isValidIPv6($value)) {
            throw new Error("Cannot serialize value as IPv6: {$value}");
        }

        return $value;
    }

    public function parseValue($value): string
    {
        if (!$this->isValidIPv6($value)) {
            throw new Error("Cannot represent value as IPv6: {$value}");
        }

        return $value;
    }

    public function parseLiteral($valueNode, ?array $variables = null): string
    {
        if (!$valueNode instanceof StringValueNode) {
            throw new Error('Query error: Can only parse strings got: ' . $valueNode->kind, [$valueNode]);
        }

        if (!$this->isValidIPv6($valueNode->value)) {
            throw new Error("Not a valid IPv6: {$valueNode->value}");
        }

        return $valueNode->value;
    }

    protected function isValidIPv6($value): bool
    {
        return filter_var($value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) !== false;
    }
}