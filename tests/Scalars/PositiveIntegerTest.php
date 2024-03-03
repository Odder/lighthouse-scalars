<?php

use Odder\LighthouseScalars\Scalars\PositiveInteger;
use GraphQL\Language\AST\IntValueNode;
use GraphQL\Error\Error;

beforeEach(function () {
    $this->scalar = new PositiveInteger();
});

test('serializes valid positive integers correctly', function () {
    $validIntegers = [
        0, 10, 100, // Add more valid positive integers as necessary
    ];

    foreach ($validIntegers as $integer) {
        expect($this->scalar->serialize($integer))->toBe($integer);
    }
});

test('rejects non-positive integers during serialization', function () {
    $invalidIntegers = [
        -1, -100, // Add more invalid (non-positive) integers as necessary
    ];

    foreach ($invalidIntegers as $integer) {
        expect(fn() => $this->scalar->serialize($integer))->toThrow(Error::class);
    }
});

test('parses valid positive integers correctly from values', function () {
    $validIntegers = [
        0, 20, 300, // Add more valid positive integers as necessary
    ];

    foreach ($validIntegers as $integer) {
        expect($this->scalar->parseValue($integer))->toBe($integer);
    }
});

test('rejects non-positive integers during parsing from values', function () {
    $invalidIntegers = [
        -10, -1, -200, // Add more invalid (non-positive) integers as necessary
    ];

    foreach ($invalidIntegers as $integer) {
        expect(fn() => $this->scalar->parseValue($integer))->toThrow(Error::class);
    }
});

test('parses literal positive integers correctly', function () {
    $validInteger = 123;
    $node = new IntValueNode(['value' => (string) $validInteger]);
    expect($this->scalar->parseLiteral($node, null))->toBe($validInteger);
});

test('rejects non-positive integers and non-integer literals', function () {
    $invalidValues = [
        new IntValueNode(['value' => '-1']),
    ];

    foreach ($invalidValues as $valueNode) {
        expect(fn() => $this->scalar->parseLiteral($valueNode, null))->toThrow(Error::class);
    }
});
