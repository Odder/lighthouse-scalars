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
        try {
            $value = $this->coerceOut($value);

            if (!$this->isValidOut($value)) {
                throw new \Exception();
            }
        } catch (\Throwable $e) {
            $className = self::class;
            throw new Error("Cannot serialize value as {$className}: {$value}");
        }

        return $value;
    }

    public function parseValue($value): mixed
    {
        try {
            $value = $this->coerce($value);

            if (!$this->isValid($value)) {
                throw new \Exception();
            }
        } catch (\Throwable $e) {
            $className = self::class;
            throw new Error("Cannot represent value as {$className}: {$value}");
        }

        return $value;
    }

    public function parseLiteral($valueNode, ?array $variables = null): mixed
    {
        try {
            $value = $this->coerce($valueNode->value);

            if (!$this->isValid($value)) {
                throw new \Exception();
            }
        } catch (\Throwable $e) {
            $className = self::class;
            throw new Error("Cannot represent value as {$className}: {$valueNode->value}");
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