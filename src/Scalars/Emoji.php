<?php

namespace Odder\LighthouseScalars\Scalars;

use Emoji as EmojiDetector;
use Odder\LighthouseScalars\Core\GenericScalarType;

/**
 * The `Emoji` scalar type represents a string containing exactly one emoji.
 * This scalar ensures that the input is a single emoji character, using the emoji-detector-php library for validation.
 */
class Emoji extends GenericScalarType
{
    public ?string $description = <<<TXT
        The `Emoji` scalar type represents a string containing exactly one emoji. It ensures that inputs are exactly one emoji character, validated using the emoji-detector-php library. This scalar is ideal for applications requiring strict validation of emoji input in GraphQL queries and mutations.
        TXT;

    /**
     * Validates if the provided string is exactly one emoji.
     *
     * @param $value
     * @return bool
     */
    protected function isValid($value): bool
    {
        return EmojiDetector\is_single_emoji($value) !== false;
    }
}
