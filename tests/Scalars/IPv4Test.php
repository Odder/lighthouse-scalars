<?php

use Odder\LighthouseScalars\Scalars\IPv4;
use GraphQL\Language\AST\StringValueNode;

beforeEach(function () {
    $this->scalar = new IPv4();
});

test('serializes valid IPv4 addresses correctly', function () {
    $validAddresses = [
        '192.168.1.1',
        '127.0.0.1',
        '255.255.255.255',
        '0.0.0.0',
    ];

    foreach ($validAddresses as $address) {
        expect($this->scalar->serialize($address))->toBe($address);
    }
});

test('rejects invalid IPv4 addresses during serialization', function () {
    $invalidAddresses = [
        '192.168.1.256', // last octet is out of range
        '127.0.0', // incomplete address
        '255.255.255.255.255', // too many octets
        'not.an.ip',
    ];

    foreach ($invalidAddresses as $address) {
        expect(fn() => $this->scalar->serialize($address))->toThrow(\GraphQL\Error\InvariantViolation::class);
    }
});

test('parses valid IPv4 addresses correctly', function () {
    $validAddresses = [
        '192.168.1.1',
        '127.0.0.1',
        '255.255.255.255',
        '0.0.0.0',
    ];

    foreach ($validAddresses as $address) {
        expect($this->scalar->parseValue($address))->toBe($address);
    }
});

test('rejects invalid IPv4 addresses during parsing', function () {
    $invalidAddresses = [
        '192.168.1.256', // last octet is out of range
        '127.0.0', // incomplete address
        '255.255.255.255.255', // too many octets
        'not.an.ip',
    ];

    foreach ($invalidAddresses as $address) {
        expect(fn() => $this->scalar->parseValue($address))->toThrow(GraphQL\Error\Error::class);
    }
});

test('parses literal values correctly', function () {
    $validAddress = '192.168.1.1';
    $node = new StringValueNode(['value' => $validAddress]);
    expect($this->scalar->parseLiteral($node, null))->toBe($validAddress);
});

test('rejects invalid literal values', function () {
    $invalidAddress = '192.168.1.256';
    $node = new StringValueNode(['value' => $invalidAddress]);
    expect(fn() => $this->scalar->parseLiteral($node, null))->toThrow(GraphQL\Error\Error::class);
});