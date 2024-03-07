<?php

use Odder\LighthouseScalars\Scalars\GeoCoordinate;
use GraphQL\Language\AST\StringValueNode;

beforeEach(function () {
    $this->scalar = new GeoCoordinate();
});

test('serializes decimal coordinates correctly', function () {
    $decimal = 53.471;
    expect($this->scalar->serialize($decimal))->toBe($decimal);
});

test('rejects invalid decimal coordinates during serialization', function () {
    $invalidDecimal = 181; // Out of valid range
    expect(fn() => $this->scalar->serialize($invalidDecimal))->toThrow(\GraphQL\Error\InvariantViolation::class);
});

test('parses decimal coordinates correctly', function () {
    $decimal = "53.471";
    expect($this->scalar->parseValue($decimal))->toBe(53.471);
});

test('parses sexagesimal coordinates correctly', function () {
    $sexagesimal = "53° 28' 36\"";
    $expected = 53.4766666667;
    $delta = 0.0001;

    $result = $this->scalar->parseValue($sexagesimal);
    expect(abs($expected - $result))->toBeLessThan($delta);
});

test('rejects invalid formats during parsing', function () {
    $invalidFormat = "invalid format";
    expect(fn() => $this->scalar->parseValue($invalidFormat))->toThrow(GraphQL\Error\Error::class);
});

test('parses literal values correctly', function () {
    $decimal = "53.471";
    $node = new StringValueNode(['value' => $decimal]);
    expect($this->scalar->parseLiteral($node, null))->toBe(53.471);
});
