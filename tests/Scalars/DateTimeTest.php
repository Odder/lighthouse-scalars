<?php

use Carbon\Carbon;
use Odder\LighthouseScalars\Scalars\DateTime;

beforeEach(function () {
    $this->scalar = new DateTime();
});

test('validates correct date formats', function () {
    expect($this->scalar->parseValue('2024-03-02T04:32:12Z')->isoFormat('YYYY-MM-DD'))->toBe('2024-03-02');
    expect($this->scalar->parseValue('2024-03-02T04:32:12Z')->isoFormat('HH:MM:ss'))->toBe('04:03:12');
    expect($this->scalar->parseValue('2024-03-02T04:32:12.123456Z')->isoFormat('ss.SSSSSS'))->toBe('12.123456');
});

test('rejects incorrect data formats', function () {
    expect(fn() => $this->scalar->parseValue('202433232'))->toThrow(GraphQL\Error\Error::class);
    expect(fn() => $this->scalar->parseValue('2023-33-03'))->toThrow(GraphQL\Error\Error::class);
    expect(fn() => $this->scalar->parseValue('2023-02-32'))->toThrow(GraphQL\Error\Error::class);
});

test('serializes date correctly', function () {
    $date = Carbon::parse('2024-03-02 00:00:00');
    expect($this->scalar->serialize($date))->toBe('2024-03-02T00:00:00.000000Z');
});