<?php

namespace Odder\LighthouseScalars\Scalars;

use GraphQL\Type\Definition\ScalarType;
use GraphQL\Error\Error;
use GraphQL\Language\AST\StringValueNode;
use Odder\LighthouseScalars\Concerns\ValidatesCountryCode;

class CountryCode extends ScalarType
{
    use ValidatesCountryCode;

    public ?string $description = <<<TXT
        The `CountryCode` scalar type represents country codes as specified by ISO 3166-1 alpha-2.
        TXT;

    public function serialize($value): string
    {
        if (!$this->isValidCountryCode($value)) {
            throw new Error("Cannot serialize value as CountryCode: {$value}");
        }

        return $value;
    }

    public function parseValue($value): string
    {
        if (!$this->isValidCountryCode($value)) {
            throw new Error("Cannot represent value as CountryCode: {$value}");
        }

        return $value;
    }

    public function parseLiteral($valueNode, ?array $variables = null): string
    {
        if (!$valueNode instanceof StringValueNode) {
            throw new Error('Query error: Can only parse strings got: ' . $valueNode->kind, [$valueNode]);
        }

        if (!$this->isValidCountryCode($valueNode->value)) {
            throw new Error("Not a valid CountryCode: {$valueNode->value}");
        }

        return $valueNode->value;
    }
}