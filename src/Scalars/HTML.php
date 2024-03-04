<?php

namespace Odder\LighthouseScalars\Scalars;

use HTMLPurifier;
use HTMLPurifier_Config;
use Odder\LighthouseScalars\Core\GenericScalarType;

/**
 * Represents HTML formatted text with sanitization using HTMLPurifier.
 *
 * This scalar type accepts strings formatted as HTML and sanitizes them to ensure
 * safety against XSS attacks and other vulnerabilities. It uses HTMLPurifier to clean
 * the HTML content according to a customizable configuration.
 */
class HTML extends GenericScalarType
{
    /**
     * @var ?string A description of the HTML scalar type.
     */
    public ?string $description = <<<TXT
        The `HTML` scalar type represents HTML formatted text. This scalar is used to validate and sanitize HTML content within GraphQL queries and mutations.
        The HTML content is sanitized using HTMLPurifier to ensure safety against XSS attacks and other vulnerabilities.
        TXT;
    /**
     * @var HTMLPurifier The HTMLPurifier instance used for sanitizing HTML content.
     */
    protected $purifier;

    /**
     * Constructor for the HTML scalar type.
     */
    public function __construct()
    {
        $config = HTMLPurifier_Config::createDefault();
        $this->purifier = new HTMLPurifier($config);

        parent::__construct();
    }

    protected function coerce($value): mixed
    {
        return $this->purifier->purify($value);
    }

    protected function coerceOut($value): mixed
    {
        return $this->purifier->purify($value);
    }
}
