<?php

namespace Odder\LighthouseScalars\Scalars;

use GraphQL\Type\Definition\ScalarType;
use GraphQL\Error\Error;
use GraphQL\Language\AST\StringValueNode;

class URL extends ScalarType
{
    public $description = <<<TXT
        The `URL` scalar type represents a valid URL as specified by RFC 3986.
        Only URLs with "http" or "https" schemes are considered valid.
        TXT;

    public function serialize($value): string
    {
        if (!$this->isValidUrl($value)) {
            throw new Error("Cannot serialize value as URL: " . $value);
        }
        return $value;
    }

    public function parseValue($value): string
    {
        if (!$this->isValidUrl($value)) {
            throw new Error("Cannot treat value as URL: " . $value);
        }
        return $value;
    }

    public function parseLiteral($valueNode, ?array $variables = null): string
    {
        if (!$valueNode instanceof StringValueNode) {
            throw new Error('URL must be a string');
        }

        if (!$this->isValidUrl($valueNode->value)) {
            throw new Error("Not a valid URL: " . $valueNode->value);
        }

        return $valueNode->value;
    }

    private function isValidUrl($value): bool
    {
        $parts = parse_url($value);
        return $parts !== false &&
            isset($parts['scheme']) &&
            in_array(strtolower($parts['scheme']), ['http', 'https'], true) &&
            isset($parts['host']);
    }
}