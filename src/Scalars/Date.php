<?php

namespace Odder\LighthouseScalars\Scalars;

use Carbon\Carbon;
use GraphQL\Error\Error;
use Odder\LighthouseScalars\Core\StringScalarType;

class Date extends StringScalarType
{
    public ?string $description = <<<TXT
        The `Date` scalar type represents a date in the format YYYY-MM-DD.
        TXT;

    /**
     * @param mixed $value
     * @return Carbon
     * @throws Error
     */
    protected function coerce($value): Carbon
    {
        $value = parent::coerce($value);
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $value)) {
            throw new Error('Query error: not a valid date format', [$value]);
        }
        return Carbon::parse($value);
    }

    /**
     * @param Carbon $value
     * @return string
     */
    protected function coerceOut($value): string
    {
        return $value->format('Y-m-d');
    }
}