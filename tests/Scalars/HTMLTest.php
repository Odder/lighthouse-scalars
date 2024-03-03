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
