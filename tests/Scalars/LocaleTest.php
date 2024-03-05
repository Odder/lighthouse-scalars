<?php

use Odder\LighthouseScalars\Scalars\Locale;
use GraphQL\Language\AST\StringValueNode;

beforeEach(function () {
    $this->scalar = new Locale();
});

test('serializes valid country codes correctly', function () {
    $validCodes = [
        'da', 'da-DK', 'da_DK',
    ];

    foreach ($validCodes as $code) {
        expect($this->scalar->serialize($code))->toBe(str_replace('_', '-', $code));
    }
});

test('rejects invalid country codes during serialization', function () {
    $invalidCodes = [
        'XX', 'afr', '', 'da_XX, en-US-XX',
    ];

    foreach ($invalidCodes as $code) {
        expect(fn() => $this->scalar->serialize($code))->toThrow(GraphQL\Error\Error::class);
    }
});

test('parses valid country codes correctly', function () {
    $validCodes = [
        'da', 'da-DK', 'da_DK',
    ];

    foreach ($validCodes as $code) {
        expect($this->scalar->serialize($code))->toBe(str_replace('_', '-', $code));
    }
});

test('rejects invalid country codes during parsing', function () {
    $invalidCodes = [
        'XX', 'afr', '', 'da_XX',
    ];

    foreach ($invalidCodes as $code) {
        expect(fn() => $this->scalar->parseValue($code))->toThrow(GraphQL\Error\Error::class);
    }
});

test('parses literal values correctly', function () {
    $validCode = 'en-US';
    $node = new StringValueNode(['value' => $validCode]);
    expect($this->scalar->parseLiteral($node, null))->toBe($validCode);
});

test('rejects invalid literal values', function () {
    $invalidCode = 'XX';
    $node = new StringValueNode(['value' => $invalidCode]);
    expect(fn() => $this->scalar->parseLiteral($node, null))->toThrow(GraphQL\Error\Error::class);
});