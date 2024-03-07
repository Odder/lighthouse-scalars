<?php

use GraphQL\Error\InvariantViolation;
use GraphQL\Language\AST\FloatValueNode;
use GraphQL\Language\AST\IntValueNode;
use GraphQL\Language\AST\StringValueNode;
use GraphQL\Error\Error;
use Odder\LighthouseScalars\Core\FloatScalarType;
use Odder\LighthouseScalars\Core\IntScalarType;

beforeEach(function () {
    $this->scalar = new FloatScalarType();
});

it('can serialize numerics', function () {
    expect($this->scalar->serialize(123))->toBe(123.0);
    expect($this->scalar->serialize(123.45))->toBe(123.45);
    expect($this->scalar->serialize('123'))->toBe(123.0);
});

it ('rejects non-numerics when serializing', function () {
    expect(fn() => $this->scalar->serialize('foo'))->toThrow(InvariantViolation::class);
    expect(fn() => $this->scalar->serialize('f1o2o'))->toThrow(InvariantViolation::class);
});

it('can parse numerics', function () {
    expect($this->scalar->parseValue(123))->toBe(123.0);
    expect($this->scalar->parseValue(123.45))->toBe(123.45);
    expect($this->scalar->parseValue('123'))->toBe(123.0);
});

it ('rejects non-stringables when parsing', function () {
    expect(fn() => $this->scalar->parseValue('foo'))->toThrow(Error::class);
    expect(fn() => $this->scalar->parseValue('f1o2o'))->toThrow(Error::class);
});

it('can parse literal stringables', function () {
    $node = new FloatValueNode(['value' => '123']);
    expect($this->scalar->parseLiteral($node, null))->toBe(123.0);
});

it('rejects invalid literal values', function () {
    $node = new StringValueNode(['value' => 'foo']);
    expect(fn() => $this->scalar->parseLiteral($node))->toThrow(Error::class);

    $node = new IntValueNode(['value' => '123']);
    expect(fn() => $this->scalar->parseLiteral($node))->toThrow(Error::class);
});