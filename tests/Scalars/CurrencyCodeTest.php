<?php

use Odder\LighthouseScalars\Scalars\CurrencyCode;
use GraphQL\Language\AST\StringValueNode;

beforeEach(function () {
    $this->scalar = new CurrencyCode();
});

test('serializes valid currency codes correctly', function () {
    $validCodes = [
        'USD', 'EUR', 'JPY', 'GBP', // Add more valid codes as necessary
    ];

    foreach ($validCodes as $code) {
        expect($this->scalar->serialize($code))->toBe($code);
    }
});

test('rejects invalid currency codes during serialization', function () {
    $invalidCodes = [
        'XXX', 'US', 'EURO', '123',
    ];

    foreach ($invalidCodes as $code) {
        expect(fn() => $this->scalar->serialize($code))->toThrow(GraphQL\Error\Error::class);
    }
});

test('parses valid currency codes correctly', function () {
    $validCodes = [
        'USD', 'EUR', 'JPY', 'GBP', // Add more valid codes as necessary
    ];

    foreach ($validCodes as $code) {
        expect($this->scalar->parseValue($code))->toBe($code);
    }
});

test('rejects invalid currency codes during parsing', function () {
    $invalidCodes = [
        'XXX', 'US', 'EURO', '123',
    ];

    foreach ($invalidCodes as $code) {
        expect(fn() => $this->scalar->parseValue($code))->toThrow(GraphQL\Error\Error::class);
    }
});

test('parses literal values correctly', function () {
    $validCode = 'USD';
    $node = new StringValueNode(['value' => $validCode]);
    expect($this->scalar->parseLiteral($node, null))->toBe($validCode);
});

test('rejects invalid literal values', function () {
    $invalidCode = 'XXX';
    $node = new StringValueNode(['value' => $invalidCode]);
    expect(fn() => $this->scalar->parseLiteral($node, null))->toThrow(GraphQL\Error\Error::class);
});