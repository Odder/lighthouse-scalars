<?php

namespace Odder\LighthouseScalars\Scalars;

use GraphQL\Type\Definition\ScalarType;
use GraphQL\Error\Error;
use GraphQL\Language\AST\StringValueNode;
use Emoji as EmojiDetector;

/**
 * The `Emoji` scalar type represents a string containing exactly one emoji.
 * This scalar ensures that the input is a single emoji character, using the emoji-detector-php library for validation.
 */
class Emoji extends ScalarType
{
    public ?string $description = <<<TXT
        The `Emoji` scalar type represents a string containing exactly one emoji. It ensures that inputs are exactly one emoji character, validated using the emoji-detector-php library. This scalar is ideal for applications requiring strict validation of emoji input in GraphQL queries and mutations.
        TXT;

    /**
     * Serializes an internal value to include in a response.
     *
     * @param mixed $value
     * @return string
     * @throws Error
     */
    public function serialize($value): string
    {
        if (!$this->isValidEmoji($value)) {
            throw new Error("Cannot serialize value as emoji: " . $value);
        }

        return $value;
    }

    /**
     * Parses an externally provided value (query variable) to use as an input.
     *
     * @param mixed $value
     * @return string
     * @throws Error
     */
    public function parseValue($value): string
    {
        if (!$this->isValidEmoji($value)) {
            throw new Error("Not a valid emoji: " . $value);
        }

        return $value;
    }

    /**
     * Parses an externally provided literal value (hardcoded in GraphQL query) to use as an input.
     *
     * E.g.
     * {
     *   post(react: "😊")
     * }
     *
     * @param \GraphQL\Language\AST\Node $valueNode
     * @param mixed[]|null $variables
     * @return string
     * @throws Error
     */
    public function parseLiteral($valueNode, ?array $variables = null): string
    {
        if (!$valueNode instanceof StringValueNode) {
            throw new Error("Can only parse strings, got: " . $valueNode->kind);
        }

        $value = $valueNode->value;

        if (!$this->isValidEmoji($value)) {
            throw new Error("Not a valid emoji: " . $value);
        }

        return $value;
    }

    /**
     * Validates if the provided string is exactly one emoji.
     *
     * @param string $value
     * @return bool
     */
    private function isValidEmoji(string $value): bool
    {
        return EmojiDetector\is_single_emoji($value) !== false;
    }
}
