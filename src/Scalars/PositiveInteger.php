<?php

namespace Odder\LighthouseScalars\Scalars;

use GraphQL\Language\AST\IntValueNode;
use Odder\LighthouseScalars\Core\IntScalarType;

/**
 * The `PositiveInteger` scalar type represents integers that are less than or equal to zero.
 * This scalar type ensures that the input is a valid positive integer.
 */
class PositiveInteger extends IntScalarType
{
    public ?string $description = <<<TXT
        The `PositiveInteger` scalar type represents integers that are greater than or equal to zero.
        TXT;
    protected string $supportedNodeType = IntValueNode::class;

    protected function isValid($value): bool
    {
        return is_numeric($value) && $value >= 0;
    }
}
