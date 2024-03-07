<?php

namespace Odder\LighthouseScalars\Core;

use GraphQL\Error\InvariantViolation;
use GraphQL\Language\AST\ValueNode;
use GraphQL\Type\Definition\ScalarType;
use GraphQL\Error\Error;

class GenericScalarType extends ScalarType
{
    protected string $supportedNodeType = ValueNode::class;

    public function serialize($value): mixed
    {
        try {
            $value = $this->coerceOut($value);

            if (!$this->isValidOut($value)) {
                throw new \Exception();
            }
        } catch (\Throwable $e) {
            $className = self::class;
            $value = is_scalar($value) ? $value : gettype($value);
            throw new InvariantViolation("Cannot serialize value as {$className}: {$value}");
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
        } catch (\Throwable) {
            $className = self::class;
            throw new Error("Cannot represent value as {$className}: {$value}");
        }

        return $value;
    }

    public function parseLiteral($valueNode, ?array $variables = null): mixed
    {
        try {
            if (!$valueNode instanceof $this->supportedNodeType) {
                throw new \Exception;
            }

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
        return $value;
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