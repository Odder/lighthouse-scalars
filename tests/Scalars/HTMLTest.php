<?php

use Odder\LighthouseScalars\Scalars\HTML;
use GraphQL\Language\AST\StringValueNode;
use GraphQL\Language\AST\FloatValueNode;

beforeEach(function () {
    $this->scalar = new HTML();
});

test('sanitizes HTML content correctly', function () {
    $dirtyHtml = '<script>alert("xss")</script><p>Valid content</p>';
    $cleanHtml = '<p>Valid content</p>'; // Expected result after purification

    expect($this->scalar->serialize($dirtyHtml))->toBe($cleanHtml);
    expect($this->scalar->parseValue($dirtyHtml))->toBe($cleanHtml);

    $node = new StringValueNode(['value' => $dirtyHtml]);
    expect($this->scalar->parseLiteral($node, null))->toBe($cleanHtml);
});

test('accepts clean HTML content', function () {
    $cleanHtml = '<p>Valid content</p>';

    expect($this->scalar->serialize($cleanHtml))->toBe($cleanHtml);
    expect($this->scalar->parseValue($cleanHtml))->toBe($cleanHtml);

    $node = new StringValueNode(['value' => $cleanHtml]);
    expect($this->scalar->parseLiteral($node, null))->toBe($cleanHtml);
});

test('rejects non-string content', function () {
    $nonStringContent = 12345; // Non-string content

    expect(fn() => $this->scalar->serialize($nonStringContent))->toThrow(GraphQL\Error\Error::class);
    expect(fn() => $this->scalar->parseValue($nonStringContent))->toThrow(GraphQL\Error\Error::class);

    $node = new FloatValueNode(['value' => $nonStringContent]);
    expect(fn() => $this->scalar->parseLiteral($node, null))->toThrow(GraphQL\Error\Error::class);
});
