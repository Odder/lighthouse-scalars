<?php

namespace Odder\LighthouseScalars\Scalars;

use GraphQL\Language\AST\StringValueNode;
use Odder\LighthouseScalars\Core\GenericScalarType;

class SemVer extends GenericScalarType
{
    public ?string $description = <<<TXT
        The `SemVer` scalar type represents semantic versioning strings.
        Inputs can be in the format of `MAJOR.MINOR.PATCH` or `MAJOR.MINOR.PATCH-PRERELEASE+BUILD`.
        Outputs are always in the same format as the input.
        Examples: `1.0.0`, `2.3.4-alpha.5+build.6`
        You can read more about semantic versioning at https://semver.org/
        TXT;
    protected string $supportedNodeType = StringValueNode::class;

    protected function isValid($value): bool
    {
        return preg_match('/^(\d+)\.(\d+)\.(\d+)(?:-([0-9A-Za-z-]+(?:\.[0-9A-Za-z-]+)*))?(?:\+([0-9A-Za-z-]+(?:\.[0-9A-Za-z-]+)*))?$/', $value) > 0;
    }
}
