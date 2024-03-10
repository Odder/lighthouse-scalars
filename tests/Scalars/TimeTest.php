<?php

use Odder\LighthouseScalars\Scalars\Time;

beforeEach(function () {
    $this->scalar = new Time();
});

test('validates correct date formats', function () {
    expect($this->scalar->parseValue('9:34:13'))->toBe('9:34:13');
    expect($this->scalar->parseValue('15:34:23'))->toBe('15:34:23');
    expect($this->scalar->parseValue('14:03'))->toBe('14:03:00');
});

test('rejects incorrect data formats', function () {
    expect(fn() => $this->scalar->parseValue('203123'))->toThrow(GraphQL\Error\Error::class);
    expect(fn() => $this->scalar->parseValue('24:03:30'))->toThrow(GraphQL\Error\Error::class);
    expect(fn() => $this->scalar->parseValue('14:60:30'))->toThrow(GraphQL\Error\Error::class);
    expect(fn() => $this->scalar->parseValue('14:03:60'))->toThrow(GraphQL\Error\Error::class);
    expect(fn() => $this->scalar->parseValue('14:03:03:03'))->toThrow(GraphQL\Error\Error::class);
});

test('serializes date correctly', function () {
    expect($this->scalar->serialize('9:34:13'))->toBe('9:34:13');
});