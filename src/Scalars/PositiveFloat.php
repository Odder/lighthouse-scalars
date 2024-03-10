<?php

namespace Odder\LighthouseScalars\Scalars;

use GraphQL\Language\AST\FloatValueNode;
use Odder\LighthouseScalars\Core\FloatScalarType;

/**
 * The `PositiveFloat` scalar type represents floating point numbers that are greater than or equal to zero.
 * This scalar type ensures that the input is a valid positive floating point number.
 */
class PositiveFloat extends FloatScalarType
{
    public ?string $description = <<<TXT
        The `PositiveFloat` scalar type represents floating point numbers that are greater than or equal to zero.
        TXT;
    protected string $supportedNodeType = FloatValueNode::class;

    protected function isValid($value): bool
    {
        return is_numeric($value) && $value >= 0;
    }
}
