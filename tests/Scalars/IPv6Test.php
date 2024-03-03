<?php

use Odder\LighthouseScalars\Scalars\IPv6;
use GraphQL\Language\AST\StringValueNode;

beforeEach(function () {
    $this->scalar = new IPv6();
});

test('serializes valid IPv6 addresses correctly', function () {
    $validIPv6s = [
        '2001:0db8:85a3:0000:0000:8a2e:0370:7334',
        '::1',
        'fe80::',
    ];

    foreach ($validIPv6s as $ipv6) {
        expect($this->scalar->serialize($ipv6))->toBe($ipv6);
    }
});

test('rejects invalid IPv6 addresses during serialization', function () {
    $invalidIPv6s = [
        '192.168.1.1', // An IPv4 address
        '2001:db8::g', // Invalid character
        '', // Empty string
    ];

    foreach ($invalidIPv6s as $ipv6) {
        expect(fn() => $this->scalar->serialize($ipv6))->toThrow(GraphQL\Error\Error::class);
    }
});

test('parses valid IPv6 addresses correctly', function () {
    $validIPv6s = [
        '2001:0db8:85a3:0000:0000:8a2e:0370:7334',
        '::1',
        'fe80::',
    ];

    foreach ($validIPv6s as $ipv6) {
        expect($this->scalar->parseValue($ipv6))->toBe($ipv6);
    }
});

test('rejects invalid IPv6 addresses during parsing', function () {
    $invalidIPv6s = [
        '192.168.1.1', // An IPv4 address
        '2001:db8::g', // Invalid character
        '', // Empty string
    ];

    foreach ($invalidIPv6s as $ipv6) {
        expect(fn() => $this->scalar->parseValue($ipv6))->toThrow(GraphQL\Error\Error::class);
    }
});

test('parses literal values correctly', function () {
    $validIPv6 = '2001:0db8:85a3:0000:0000:8a2e:0370:7334';
    $node = new StringValueNode(['value' => $validIPv6]);
    expect($this->scalar->parseLiteral($node, null))->toBe($validIPv6);
});

test('rejects invalid literal values', function () {
    $invalidIPv6 = '2001:db8::g';
    $node = new StringValueNode(['value' => $invalidIPv6]);
    expect(fn() => $this->scalar->parseLiteral($node, null))->toThrow(GraphQL\Error\Error::class);
});
