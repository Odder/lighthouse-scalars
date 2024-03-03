<?php

use Odder\LighthouseScalars\Scalars\NegativeFloat;
use GraphQL\Language\AST\FloatValueNode;
use GraphQL\Error\Error;

beforeEach(function () {
    $this->scalar = new NegativeFloat();
});

test('serializes valid positive floats correctly', function () {
    $validFloats = [
        0.0, -0.1, -10.5, -100.001, // Add more valid positive floats as necessary
    ];

    foreach ($validFloats as $float) {
        expect($this->scalar->serialize($float))->toBe($float);
    }
});

test('rejects negative floats during serialization', function () {
    $invalidFloats = [
        0.1, 10.5, 100.001, // Add more invalid negative floats as necessary
    ];

    foreach ($invalidFloats as $float) {
        expect(fn() => $this->scalar->serialize($float))->toThrow(Error::class);
    }
});

test('parses valid positive floats correctly from values', function () {
    $validFloats = [
        0.0, -1.2, -20.3, -300.4, // Add more valid positive floats as necessary
    ];

    foreach ($validFloats as $float) {
        expect($this->scalar->parseValue($float))->toBe($float);
    }
});

test('rejects negative floats during parsing from values', function () {
    $invalidFloats = [
        1.2, 20.3, 300.4, // Add more invalid negative floats as necessary
    ];

    foreach ($invalidFloats as $float) {
        expect(fn() => $this->scalar->parseValue($float))->toThrow(Error::class);
    }
});

test('parses literal positive floats correctly', function () {
    $validFloat = -123.456;
    $node = new FloatValueNode(['value' => (string) $validFloat]);
    expect($this->scalar->parseLiteral($node, null))->toBe($validFloat);
});

test('rejects negative floats and non-float literals', function () {
    $invalidValues = [
        new FloatValueNode(['value' => '123.456']),
        // Additional test cases for non-float literals if necessary
    ];

    foreach ($invalidValues as $valueNode) {
        expect(fn() => $this->scalar->parseLiteral($valueNode, null))->toThrow(Error::class);
    }
});
