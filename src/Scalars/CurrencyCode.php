<?php

namespace Odder\LighthouseScalars\Scalars;

use GraphQL\Type\Definition\ScalarType;
use GraphQL\Error\Error;
use GraphQL\Language\AST\StringValueNode;
use Odder\LighthouseScalars\Concerns\ValidatesCurrencyCode;

class CurrencyCode extends ScalarType
{
    use ValidatesCurrencyCode;

    public ?string $description = <<<TXT
        The `CurrencyCode` scalar type represents currency codes as specified by ISO 4217.
        TXT;

    public function serialize($value): string
    {
        if (!$this->isValidCurrencyCode($value)) {
            throw new Error("Cannot serialize value as CurrencyCode: {$value}");
        }

        return $value;
    }

    public function parseValue($value): string
    {
        if (!$this->isValidCurrencyCode($value)) {
            throw new Error("Cannot represent value as CurrencyCode: {$value}");
        }

        return $value;
    }

    public function parseLiteral($valueNode, ?array $variables = null): string
    {
        if (!$valueNode instanceof StringValueNode) {
            throw new Error('Query error: Can only parse strings got: ' . $valueNode->kind, [$valueNode]);
        }

        if (!$this->isValidCurrencyCode($valueNode->value)) {
            throw new Error("Not a valid CurrencyCode: {$valueNode->value}");
        }

        return $valueNode->value;
    }
}