<?php

namespace Odder\LighthouseScalars\Core;

use GraphQL\Type\Definition\ScalarType;
use GraphQL\Error\Error;
use GraphQL\Language\AST\StringValueNode;

class GenericScalarType extends ScalarType
{
    protected string $supportedNodeType = StringValueNode::class;

    public function serialize($value): mixed
    {
        $value = $this->coerceOut($value);

        if (!$this->isValidOut($value)) {
            $className = self::class;
            throw new Error("Cannot serialize value as {$className}: {$value}");
        }

        return $value;
    }

    public function parseValue($value): mixed
    {
        $value = $this->coerce($value);

        if (!$this->isValid($value)) {
            $className = self::class;
            throw new Error("Cannot represent value as {$className}: {$value}");
        }

        return $value;
    }

    public function parseLiteral($valueNode, ?array $variables = null): mixed
    {
        if (!$valueNode instanceof $this->supportedNodeType) {
            throw new Error('Query error: Cannot parse this type: ' . $valueNode->kind, [$valueNode]);
        }

        $value = $this->coerce($valueNode->value);

        if (!$this->isValid($value)) {
            $className = self::class;
            throw new Error("Not a valid {$className}: {$value}");
        }

        return $value;
    }

    protected function coerce($value): mixed
    {
        return (string) $value;
    }

    protected function coerceOut($value): mixed
    {
        return $this->coerce($value);
    }

    protected function isValid($value): bool
    {
        return true;
    }

    protected function isValidOut($value): bool
    {
        return $this->isValid($value);
    }
}