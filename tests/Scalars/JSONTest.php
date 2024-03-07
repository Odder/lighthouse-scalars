<?php

use Odder\LighthouseScalars\Scalars\JSON;
use GraphQL\Language\AST\StringValueNode;

beforeEach(function () {
    $this->scalar = new JSON();
});

test('serializes JSON correctly', function () {
    $value = ['key' => 'value'];
    $json = json_encode($value);
    expect($this->scalar->serialize($value))->toBe($json);
});

test('rejects invalid JSON during serialization', function () {
    // Use an invalid UTF8 sequence to force a JSON encoding error.
    $value = ["key" => "\xB1\x31"];
    expect(fn() => $this->scalar->serialize($value))->toThrow(\GraphQL\Error\InvariantViolation::class);
});

test('parses JSON strings correctly', function () {
    $json = '{"key": "value"}';
    expect($this->scalar->parseValue($json))->toBe(['key' => 'value']);
});

test('rejects invalid JSON strings during parsing', function () {
    $invalidJson = '{"key": "value"';
    expect(fn() => $this->scalar->parseValue($invalidJson))->toThrow(GraphQL\Error\Error::class);
});

test('parses literal values correctly', function () {
    $json = '{"key": "value"}';
    $node = new StringValueNode(['value' => $json]);
    expect($this->scalar->parseLiteral($node, null))->toBe(['key' => 'value']);
});

test('rejects invalid literal values', function () {
    $invalidJson = '{"key": "value"';
    $node = new StringValueNode(['value' => $invalidJson]);
    expect(fn() => $this->scalar->parseLiteral($node, null))->toThrow(GraphQL\Error\Error::class);
});
