<?php

namespace Odder\LighthouseScalars\Scalars;

use GraphQL\Error\Error;
use GraphQL\Type\Definition\ScalarType;
use GraphQL\Language\AST\IntValueNode;

/**
 * The `PositiveInteger` scalar type represents non-negative integers, strictly greater than 0.
 */
class NegativeInteger extends ScalarType
{
    public $description = <<<TXT
        The `PositiveInteger` scalar type represents non-negative integers greater than 0. This scalar is used to validate and serialize positive integer values within GraphQL queries and mutations.
        TXT;

    /**
     * Serializes an internal value to include in a response.
     *
     * @param mixed $value
     * @return int
     * @throws Error
     */
    public function serialize($value): int
    {
        if (!is_int($value) || $value > 0) {
            throw new Error("Cannot serialize value as positive integer: " . $value);
        }

        return $value;
    }

    /**
     * Parses an externally provided value (query variable) to use as an input.
     *
     * @param mixed $value
     * @return int
     * @throws Error
     */
    public function parseValue($value): int
    {
        if (!is_int($value) || $value > 0) {
            throw new Error("Not a valid positive integer: " . $value);
        }

        return $value;
    }

    /**
     * Parses an externally provided literal value (hardcoded in GraphQL query) to use as an input.
     *
     * @param \GraphQL\Language\AST\Node $valueNode
     * @param mixed[]|null $variables
     * @return int
     * @throws Error
     */
    public function parseLiteral($valueNode, ?array $variables = null): int
    {
        if (!$valueNode instanceof IntValueNode || (int)$valueNode->value > 0) {
            throw new Error("Can only parse positive integers, got: " . $valueNode->kind);
        }

        return (int)$valueNode->value;
    }
}
