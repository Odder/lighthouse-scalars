<?php

namespace Odder\LighthouseScalars\Scalars;

use Odder\LighthouseScalars\Core\StringScalarType;
use Carbon\Carbon;

class DateTime extends StringScalarType
{
    public ?string $description = <<<TXT
        The `DateTime` scalar type represents a date in the ISO format.
        TXT;

    /**
     * @param  mixed  $value
     * @return \Carbon\Carbon
     * @throws \GraphQL\Error\Error
     */
    protected function coerce($value): Carbon
    {
        $value = parent::coerce($value);
        return Carbon::parse($value);
    }

    /**
     * @param  \Carbon\Carbon  $value
     * @return string
     */
    protected function coerceOut($value): string
    {
        return $value->toISOString();
    }
}