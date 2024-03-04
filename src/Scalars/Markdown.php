<?php

namespace Odder\LighthouseScalars\Scalars;

use GraphQL\Language\AST\StringValueNode;
use Odder\LighthouseScalars\Core\GenericScalarType;

/**
 * Represents text formatted in Markdown.
 *
 * This scalar type is designed to handle Markdown text inputs,
 * ensuring they are properly represented as strings. It provides
 * a flexible approach to handling Markdown, potentially allowing
 * for sanitization or conversion processes to be implemented as needed.
 */
class Markdown extends GenericScalarType
{
    public ?string $description = "The `Markdown` scalar type represents text formatted in Markdown.";
    protected string $supportedNodeType = StringValueNode::class;
}
