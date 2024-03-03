<?php

namespace Odder\LighthouseScalars\Scalars;

use GraphQL\Type\Definition\ScalarType;
use GraphQL\Error\Error;
use GraphQL\Language\AST\StringValueNode;

class IPv4 extends ScalarType
{
    public $description = <<<TXT
        The `IPv4` scalar type represents IPv4 addresses as specified by RFC 791.
        TXT;

    public function serialize($value): string
    {
        if (!$this->isValidIPv4($value)) {
            throw new Error("Cannot serialize value as IPv4: {$value}");
        }

        return $value;
    }

    public function parseValue($value): string
    {
        if (!$this->isValidIPv4($value)) {
            throw new Error("Cannot represent value as IPv4: {$value}");
        }

        return $value;
    }

    public function parseLiteral($valueNode, ?array $variables = null): string
    {
        if (!$valueNode instanceof StringValueNode) {
            throw new Error('Query error: Can only parse strings got: ' . $valueNode->kind, [$valueNode]);
        }

        if (!$this->isValidIPv4($valueNode->value)) {
            throw new Error("Not a valid IPv4 address: {$valueNode->value}");
        }

        return $valueNode->value;
    }

    protected function isValidIPv4($value): bool
    {
        return filter_var($value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) !== false;
    }
}