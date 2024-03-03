<?php

namespace Odder\LighthouseScalars\Scalars;

use GraphQL\Type\Definition\ScalarType;
use GraphQL\Error\Error;
use GraphQL\Language\AST\StringValueNode;
use HTMLPurifier;
use HTMLPurifier_Config;

/**
 * Represents HTML formatted text with sanitization using HTMLPurifier.
 *
 * This scalar type accepts strings formatted as HTML and sanitizes them to ensure
 * safety against XSS attacks and other vulnerabilities. It uses HTMLPurifier to clean
 * the HTML content according to a customizable configuration.
 */
class HTML extends ScalarType
{
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
        // Customize HTMLPurifier configuration as needed
        // For example, to allow certain HTML elements or attributes:
        // $config->set('HTML.Allowed', 'div,b,a[href],p');

        $this->purifier = new HTMLPurifier($config);

        parent::__construct();
    }

    /**
     * @var string A description of the HTML scalar type.
     */
    public $description = "The `HTML` scalar type represents text formatted as HTML, sanitized for security.";

    /**
     * Serializes a value to include in a response.
     *
     * @param mixed $value The value to be serialized.
     * @return string The sanitized HTML string.
     * @throws Error If the value cannot be serialized as a string.
     */
    public function serialize($value): string
    {
        if (!is_string($value)) {
            throw new Error("Cannot serialize value as HTML: Value is not a string.");
        }

        return $this->purifier->purify($value);
    }

    /**
     * Parses an externally provided value (query variable) to use as an input.
     *
     * @param mixed $value The value to be parsed.
     * @return string The sanitized HTML string.
     * @throws Error If the value cannot be represented as HTML.
     */
    public function parseValue($value): string
    {
        if (!is_string($value)) {
            throw new Error("Cannot represent value as HTML: Value is not a string.");
        }

        return $this->purifier->purify($value);
    }

    /**
     * Parses an externally provided literal value (hardcoded in GraphQL query) to use as an input.
     *
     * @param \GraphQL\Language\AST\Node $valueNode The AST node containing the value.
     * @param array|null $variables Variables provided in the GraphQL query.
     * @return string The sanitized HTML string.
     * @throws Error If the value node is not a StringValueNode or the value cannot be parsed.
     */
    public function parseLiteral($valueNode, ?array $variables = null): string
    {
        if (!$valueNode instanceof StringValueNode) {
            throw new Error('Query error: Can only parse strings got: ' . $valueNode->kind, [$valueNode]);
        }

        return $this->purifier->purify($valueNode->value);
    }
}
