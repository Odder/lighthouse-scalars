<?php

namespace Odder\LighthouseScalars\Scalars;

class Latitude extends GeoCoordinate
{
    public float $limit = 90;

    public ?string $description = <<<TXT
        The `Latitude` scalar type represents geographic coordinates.
        Inputs can be in decimal (53.471) or sexagesimal (53° 28' 36") format.
        Outputs are always in decimal format.
        TXT;
}
