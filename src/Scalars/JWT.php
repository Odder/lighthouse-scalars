<?php

namespace Odder\LighthouseScalars\Scalars;

use Odder\LighthouseScalars\Core\StringScalarType;

class JWT extends StringScalarType
{
    public ?string $description = "The `JWT` scalar only verifies the format of the JWT, not the actual content.";
    protected string $supportedNodeType = StringValueNode::class;

    protected function isValid($value): bool
    {
        return (bool) preg_match('/^[A-Za-z0-9-_]+\.[A-Za-z0-9-_]+\.[A-Za-z0-9-_]+$/', $value);
    }
}
