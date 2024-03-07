<?php

use GraphQL\Language\AST\FloatValueNode;
use GraphQL\Language\AST\IntValueNode;
use GraphQL\Language\AST\StringValueNode;
use Odder\LighthouseScalars\Core\GenericScalarType;

beforeEach(function () {
    $this->scalar = new GenericScalarType();
});

it('Handles strings', function () {
    expect($this->scalar->serialize('foo'))->toBe('foo');
    expect($this->scalar->parseValue('foo'))->toBe('foo');
    expect($this->scalar->parseLiteral(new StringValueNode(['value' => 'foo'])))->toBe('foo');
});

it('Handles integers', function () {
    expect($this->scalar->serialize(123))->toBe(123);
    expect($this->scalar->parseValue(123))->toBe(123);
    expect($this->scalar->parseLiteral(new IntValueNode(['value' => '123'])))->toBe('123');
});

it('Handles floats', function () {
    expect($this->scalar->serialize(123.45))->toBe(123.45);
    expect($this->scalar->parseValue(123.45))->toBe(123.45);
    expect($this->scalar->parseLiteral(new FloatValueNode(['value' => '123.45'])))->toBe('123.45');
});

//it('Handles stringables', function () {
//    $stringable = new class() {
//        public function __toString()
//        {
//            return 'foo';
//        }
//    };
//
//    expect($this->scalar->serialize($stringable))->toBe('foo');
//    expect($this->scalar->parseValue($stringable))->toBe('foo');
//});

