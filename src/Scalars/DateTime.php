<?php

namespace Odder\LighthouseScalars\Scalars;

use Carbon\Carbon;
use GraphQL\Error\Error;
use Odder\LighthouseScalars\Core\StringScalarType;

class DateTime extends StringScalarType
{
    public ?string $description = <<<TXT
        The `DateTime` scalar type represents a date in the ISO format.
        TXT;

    /**
     * @param mixed $value
     * @return Carbon
     * @throws Error
     */
    protected function coerce($value): Carbon
    {
        $value = parent::coerce($value);
        return Carbon::parse($value);
    }

    /**
     * @param Carbon $value
     * @return string
     */
    protected function coerceOut($value): string
    {
        return $value->toISOString();
    }
}