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

test('parses Markdown content correctly', function () {
    $markdownContent = "# Heading\nSome **bold** text.";
    expect($this->scalar->parseValue($markdownContent))->toBe($markdownContent);
});

test('parses literal values correctly', function () {
    $markdownContent = "# Heading\nSome **bold** text.";
    $node = new StringValueNode(['value' => $markdownContent]);
    expect($this->scalar->parseLiteral($node, null))->toBe($markdownContent);
});
