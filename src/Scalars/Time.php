<?php

namespace Odder\LighthouseScalars\Scalars;

use GraphQL\Error\Error;
use Odder\LighthouseScalars\Core\StringScalarType;

class Time extends StringScalarType
{
    public ?string $description = <<<TXT
        The `Time` scalar type represents a date in the format HH:MM:SS.
        TXT;

    /**
     * @param mixed $value
     * @return string
     * @throws Error
     */
    protected function coerce($value): string
    {
        $value = parent::coerce($value);
        if (preg_match('/^\d{1,2}:\d{2}$/', $value)) {
            $value .= ':00';
        }
        if (!preg_match('/^\d{1,2}:\d{2}:\d{2}$/', $value)) {
            echo 'failing here';
            throw new Error('Query error: not a valid date format', [$value]);
        }
        return $value;
    }

    protected function isValid($value): bool
    {
        [$hour, $minute, $second] = explode(':', $value);
        return $hour >= 0 && $hour <= 23 && $minute >= 0 && $minute <= 59 && $second >= 0 && $second <= 59;
    }
}