<?php

use Odder\LighthouseScalars\Scalars\CountryCode;
use GraphQL\Language\AST\StringValueNode;

beforeEach(function () {
    $this->scalar = new CountryCode();
});

test('serializes valid country codes correctly', function () {
    $validCodes = [
        'US', 'GB', 'CA', // Add more valid codes as necessary
    ];

    foreach ($validCodes as $code) {
        expect($this->scalar->serialize($code))->toBe($code);
    }
});

test('rejects invalid country codes during serialization', function () {
    $invalidCodes = [
        'XX', 'AAA', '', '123',
    ];

    foreach ($invalidCodes as $code) {
        expect(fn() => $this->scalar->serialize($code))->toThrow(\GraphQL\Error\InvariantViolation::class);
    }
});

test('parses valid country codes correctly', function () {
    $validCodes = [
        'US', 'GB', 'CA', // Add more valid codes as necessary
    ];

    foreach ($validCodes as $code) {
        expect($this->scalar->parseValue($code))->toBe($code);
    }
});

test('rejects invalid country codes during parsing', function () {
    $invalidCodes = [
        'XX', 'AAA', '', '123',
    ];

    foreach ($invalidCodes as $code) {
        expect(fn() => $this->scalar->parseValue($code))->toThrow(GraphQL\Error\Error::class);
    }
});

test('parses literal values correctly', function () {
    $validCode = 'US';
    $node = new StringValueNode(['value' => $validCode]);
    expect($this->scalar->parseLiteral($node, null))->toBe($validCode);
});

test('rejects invalid literal values', function () {
    $invalidCode = 'XX';
    $node = new StringValueNode(['value' => $invalidCode]);
    expect(fn() => $this->scalar->parseLiteral($node, null))->toThrow(GraphQL\Error\Error::class);
});