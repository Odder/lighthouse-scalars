<?php

use Odder\LighthouseScalars\Scalars\SemVer;
use GraphQL\Language\AST\StringValueNode;

beforeEach(function () {
    $this->scalar = new SemVer();
});

test('serializes SemVer formatted strings correctly', function () {
    $validVersions = [
        '1.0.0',
        '2.1.0',
        '3.0.1-alpha',
        '4.0.0+build.1',
        '1.0.0-alpha+001',
        // Add more examples as needed
    ];

    foreach ($validVersions as $version) {
        expect($this->scalar->serialize($version))->toBe($version);
    }
});

test('rejects invalid SemVer formatted strings during serialization', function () {
    $invalidVersions = [
        '1.0', // Missing PATCH
        '1.0.0.0', // Too many segments
        'a.b.c', // Non-numeric
        // Add more examples as needed
    ];

    foreach ($invalidVersions as $version) {
        expect(fn() => $this->scalar->serialize($version))->toThrow(\GraphQL\Error\InvariantViolation::class);
    }
});

test('parses SemVer formatted strings correctly', function () {
    $validVersions = [
        '1.0.0',
        '2.1.0',
        // Add more examples as needed
    ];

    foreach ($validVersions as $version) {
        expect($this->scalar->parseValue($version))->toBe($version);
    }
});

test('rejects invalid SemVer formatted strings during parsing', function () {
    $invalidVersions = [
        '1.0', // Missing PATCH
        // Add more examples as needed
    ];

    foreach ($invalidVersions as $version) {
        expect(fn() => $this->scalar->parseValue($version))->toThrow(GraphQL\Error\Error::class);
    }
});
