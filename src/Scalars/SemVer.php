<?php

namespace Odder\LighthouseScalars\Scalars;

use GraphQL\Type\Definition\ScalarType;
use GraphQL\Error\Error;
use GraphQL\Language\AST\StringValueNode;

class SemVer extends ScalarType
{
    public $description = <<<TXT
        The `SemVer` scalar type represents version numbers following the Semantic Versioning Specification (SemVer).
        TXT;

    public function serialize($value): string
    {
        if (!$this->isValidSemVer($value)) {
            throw new Error("Cannot serialize value as SemVer: {$value}");
        }

        return $value;
    }

    public function parseValue($value): string
    {
        if (!$this->isValidSemVer($value)) {
            throw new Error("Cannot represent value as SemVer: {$value}");
        }

        return $value;
    }

    public function parseLiteral($valueNode, ?array $variables = null): string
    {
        if (!$valueNode instanceof StringValueNode) {
            throw new Error('Query error: Can only parse strings got: ' . $valueNode->kind, [$valueNode]);
        }

        if (!$this->isValidSemVer($valueNode->value)) {
            throw new Error("Not a valid SemVer: {$valueNode->value}");
        }

        return $valueNode->value;
    }

    protected function isValidSemVer($value): bool
    {
        return preg_match('/^(\d+)\.(\d+)\.(\d+)(?:-([0-9A-Za-z-]+(?:\.[0-9A-Za-z-]+)*))?(?:\+([0-9A-Za-z-]+(?:\.[0-9A-Za-z-]+)*))?$/', $value) > 0;
    }
}
