<?php

use Odder\LighthouseScalars\Scalars\Markdown;
use GraphQL\Language\AST\StringValueNode;

beforeEach(function () {
    $this->scalar = new Markdown();
});

test('serializes Markdown content correctly', function () {
    $markdownContent = "# Heading\nSome **bold** text.";
    expect($this->scalar->serialize($markdownContent))->toBe($markdownContent);
});

test('rejects non-string content during serialization', function () {
    $nonStringContent = 12345; // Non-string content
    expect(fn() => $this->scalar->serialize($nonStringContent))->toThrow(GraphQL\Error\Error::class);
});

test('parses Markdown content correctly', function () {
    $markdownContent = "# Heading\nSome **bold** text.";
    expect($this->scalar->parseValue($markdownContent))->toBe($markdownContent);
});

test('rejects non-string content during parsing', function () {
    $nonStringContent = 12345; // Non-string content
    expect(fn() => $this->scalar->parseValue($nonStringContent))->toThrow(GraphQL\Error\Error::class);
});

test('parses literal values correctly', function () {
    $markdownContent = "# Heading\nSome **bold** text.";
    $node = new StringValueNode(['value' => $markdownContent]);
    expect($this->scalar->parseLiteral($node, null))->toBe($markdownContent);
});
