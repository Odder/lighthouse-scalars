<?php

use GraphQL\Error\InvariantViolation;
use GraphQL\Language\AST\FloatValueNode;
use GraphQL\Language\AST\IntValueNode;
use GraphQL\Language\AST\StringValueNode;
use Odder\LighthouseScalars\Core\StringScalarType;
use GraphQL\Error\Error;

beforeEach(function () {
    $this->scalar = new StringScalarType();
    $this->stringable = new class() {
        public function __toString()
        {
            return 'foo';
        }
    };
});

it('can serialize stringables', function () {
    expect($this->scalar->serialize('foo'))->toBe('foo');
    expect($this->scalar->serialize(123))->toBe('123');
    expect($this->scalar->serialize(new $this->stringable))->toBe('foo');
});

it ('rejects non-stringables when serializing', function () {
    try {
        $this->scalar->serialize(new stdClass());
    } catch (Throwable $e) {
        echo "Caught exception of type: ", get_class($e), " with message:", $e->getMessage(), "\n";
    }
    expect(fn() => $this->scalar->serialize(new stdClass()))->toThrow(InvariantViolation::class);
});

it('can parse stringables', function () {
    expect($this->scalar->parseValue('foo'))->toBe('foo');
    expect($this->scalar->parseValue(123))->toBe('123');
    expect($this->scalar->parseValue(new $this->stringable))->toBe('foo');
});

it ('rejects non-stringables when parsing', function () {
    expect(fn() => $this->scalar->parseValue(null))->toThrow(Error::class);
});

it('can parse literal stringables', function () {
    $node = new StringValueNode(['value' => 'foo']);
    expect($this->scalar->parseLiteral($node, null))->toBe('foo');
});

it('rejects invalid literal values', function () {
    $node = new IntValueNode(['value' => '123']);
    expect(fn() => $this->scalar->parseLiteral($node))->toThrow(Error::class);

    $node = new FloatValueNode(['value' => '123']);
    expect(fn() => $this->scalar->parseLiteral($node))->toThrow(Error::class);
});