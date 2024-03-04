<?php

namespace Odder\LighthouseScalars\Scalars;

use GraphQL\Language\AST\FloatValueNode;
use Odder\LighthouseScalars\Core\GenericScalarType;

/**
 * The `NegativeFloat` scalar type represents floating point numbers that are less than or equal to zero.
 * This scalar type ensures that the input is a valid negative floating point number.
 */
class NegativeFloat extends GenericScalarType
{
    public ?string $description = <<<TXT
        The `NegativeFloat` scalar type represents floating point numbers that are less than or equal to zero.
        TXT;
    protected string $supportedNodeType = FloatValueNode::class;

    protected function coerce($value): mixed
    {
        return is_numeric($value) ? (float)$value : $value;
    }

    protected function isValid($value): bool
    {
        return is_numeric($value) && $value <= 0;
    }
}
