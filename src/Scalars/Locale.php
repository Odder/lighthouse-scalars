<?php

namespace Odder\LighthouseScalars\Scalars;

use GraphQL\Type\Definition\ScalarType;
use GraphQL\Error\Error;
use GraphQL\Language\AST\StringValueNode;
use Odder\LighthouseScalars\Concerns\ValidatesCountryCode;
use Odder\LighthouseScalars\Concerns\ValidatesLanguageCode;
use Odder\LighthouseScalars\Core\GenericScalarType;

/**
 * The `Locale` scalar type represents locale identifiers, including language codes, optional script, and region codes.
 * This scalar ensures that the input matches the structure of locale identifiers like "en", "en-US".
 */
class Locale extends GenericScalarType
{
    use ValidatesCountryCode;
    use ValidatesLanguageCode;

    public ?string $description = <<<TXT
        The `Locale` scalar type represents locale identifiers compliant with IETF language tag format, which may include a language code, an optional script code, and an optional region code, such as "en", "en-US", or "zh-CN". Underscores in the input will be converted to hyphens to normalize the locale identifier.
        TXT;

    protected function coerce($value): string
    {
        return str_replace('_', '-', $value);
    }

    protected function isValid($value): bool
    {
        $parts = explode('-', $value);

        if (count($parts) > 2) {
            return false;
        }

        $language = $parts[0];
        $country = $parts[1] ?? '';
        return $this->isValidLanguageCode($language) && ($country === '' || $this->isValidCountryCode($country));
    }
}
