<?php

use Carbon\Carbon;
use Odder\LighthouseScalars\Scalars\Date;
use GraphQL\Language\AST\StringValueNode;

beforeEach(function () {
    $this->scalar = new Date();
});

test('validates correct date formats', function () {
    expect($this->scalar->parseValue('2024-03-02')->isoFormat('Y-MM-DD'))->toBe('2024-03-02');
    expect($this->scalar->parseValue('2024-12-12')->isoFormat('Y-MM-DD'))->toBe('2024-12-12');
});

test('rejects incorrect data formats', function () {
    expect(fn() => $this->scalar->parseValue('202433232'))->toThrow(GraphQL\Error\Error::class);
    expect(fn() => $this->scalar->parseValue('2023-33-03'))->toThrow(GraphQL\Error\Error::class);
    expect(fn() => $this->scalar->parseValue('2023-02-32'))->toThrow(GraphQL\Error\Error::class);
});

test('serializes date correctly', function () {
    $date = Carbon::createFromDate(2024, 3, 2);
    expect($this->scalar->serialize($date))->toBe('2024-03-02');
});