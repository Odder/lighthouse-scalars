<?php

namespace Odder\LighthouseScalars\Scalars;

use GraphQL\Type\Definition\ScalarType;
use GraphQL\Error\Error;
use GraphQL\Language\AST\StringValueNode;
use GraphQL\Language\AST\Node;

class GeoCoordinate extends ScalarType
{
    public float $limit = 180;

    public ?string $description = <<<TXT
        The `GeoCoordinate` scalar type represents geographic coordinates.
        Inputs can be in decimal (53.471) or sexagesimal (53° 28' 36") format.
        Outputs are always in decimal format.
        TXT;

    public function serialize($value): float
    {
        // Assuming $value is already in decimal format
        if (!$this->isValidDecimal($value)) {
            throw new Error("Cannot serialize value as GeoCoordinate: {$value}");
        }

        return (float)$value;
    }

    public function parseValue($value): float
    {
        if ($this->isSexagesimal($value)) {
            $value = $this->convertSexagesimalToDecimal($value);
        }

        if ($this->isValidDecimal($value)) {
            return (float) $value;
        } else {
            throw new Error("Cannot represent value as GeoCoordinate: {$value}");
        }
    }

    public function parseLiteral($valueNode, ?array $variables = null): float
    {
        if (!$valueNode instanceof StringValueNode) {
            throw new Error('Query error: Can only parse strings got: ' . $valueNode->kind, [$valueNode]);
        }

        return $this->parseValue($valueNode->value);
    }

    protected function isValidDecimal($value): bool
    {
        return is_numeric($value) && $value >= -$this->limit && $value <= $this->limit;
    }

    protected function isSexagesimal($value): bool
    {
        return preg_match('/^(\d+)° ?(\d+)\' ?(\d+)"/', $value) > 0;
    }

    protected function convertSexagesimalToDecimal($value): float
    {
        preg_match('/^(\d+)° ?(\d+)\' ?(\d+)"/', $value, $matches);
        $degrees = (int) $matches[1];
        $degrees += ((int) $matches[2]) / 60;
        $degrees += ((int) $matches[3]) / 3600;

        return $degrees;
    }
}
