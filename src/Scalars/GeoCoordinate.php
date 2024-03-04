<?php

namespace Odder\LighthouseScalars\Scalars;

use Odder\LighthouseScalars\Core\GenericScalarType;

class GeoCoordinate extends GenericScalarType
{
    public float $limit = 180;

    public ?string $description = <<<TXT
        The `GeoCoordinate` scalar type represents geographic coordinates.
        Inputs can be in decimal (53.471) or sexagesimal (53° 28' 36") format.
        Outputs are always in decimal format.
        TXT;

    protected function coerce($value): mixed
    {
        if ($this->isSexagesimal($value)) {
            return $this->convertSexagesimalToDecimal($value);
        }

        return is_numeric($value) ? (float)$value : $value;
    }

    private function isSexagesimal($value): bool
    {
        return preg_match('/^(\d+)° ?(\d+)\' ?(\d+)"/', $value) > 0;
    }

    private function convertSexagesimalToDecimal($value): float
    {
        preg_match('/^(\d+)° ?(\d+)\' ?(\d+)"/', $value, $matches);
        $degrees = (int)$matches[1];
        $degrees += ((int)$matches[2]) / 60;
        $degrees += ((int)$matches[3]) / 3600;

        return $degrees;
    }

    protected function coerceOut($value): float
    {
        return (float)$value;
    }

    protected function isValid($value): bool
    {
        return is_numeric($value) && $value >= -$this->limit && $value <= $this->limit;
    }
}
