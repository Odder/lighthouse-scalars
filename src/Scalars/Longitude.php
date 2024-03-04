<?php

namespace Odder\LighthouseScalars\Scalars;

class Longitude extends GeoCoordinate
{
    public float $limit = 180;

    public ?string $description = <<<TXT
        The `Longitude` scalar type represents geographic coordinates.
        Inputs can be in decimal (53.471) or sexagesimal (53° 28' 36") format.
        Outputs are always in decimal format.
        TXT;
}
