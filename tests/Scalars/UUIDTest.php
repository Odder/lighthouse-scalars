<?php

use Odder\LighthouseScalars\Scalars\UUID;
use GraphQL\Language\AST\StringValueNode;

beforeEach(function () {
    $this->scalar = new UUID();
});

test('serializes UUID strings correctly', function () {
    $validUUID = '123e4567-e89b-12d3-a456-426614174000';
    expect($this->scalar->serialize($validUUID))->toBe($validUUID);
});

test('rejects invalid UUID strings during serialization', function () {
    $invalidUUIDs = [
        '12345678-1234-1234-1234-1234567890ab', // Valid format but just an example
        'G2345678-1234-1234-1234-1234567890ab', // Invalid character 'G'
        '1234567-1234-1234-1234-1234567890ab',  // Missing a character in the first group
        // Add more examples as needed
    ];

    foreach ($invalidUUIDs as $uuid) {
        expect(fn() => $this->scalar->serialize($uuid))->toThrow(\GraphQL\Error\InvariantViolation::class);
    }
});

test('parses UUID strings correctly', function () {
    $validUUID = '123e4567-e89b-12d3-a456-426614174000';
    expect($this->scalar->parseValue($validUUID))->toBe($validUUID);
});

test('rejects invalid UUID strings during parsing', function () {
    $invalidUUID = '123e4567-e89b-12d3-a456-42661417400Z'; // Invalid character 'Z'
    expect(fn() => $this->scalar->parseValue($invalidUUID))->toThrow(GraphQL\Error\Error::class);
});
