<?php

use Odder\LighthouseScalars\Scalars\JWT;

beforeEach(function () {
    $this->scalar = new JWT();
});

test('accepts valid JWT tokens', function () {
    $valid = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ0ZXN0IjoiZ3JhcGhxbCJ9.j_rygw0W_N9XydbUvTY3cXgPqd58nU6uc6oHZoiGVTo';
    expect($this->scalar->parseValue($valid))->toBe($valid);
});

test('rejects invalid JWT tokens', function () {
    expect(fn() => $this->scalar->parseValue('invalid'))->toThrow(GraphQL\Error\Error::class);
    expect(fn() => $this->scalar->parseValue('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.efw9e8fuewf0sduf903'))->toThrow(GraphQL\Error\Error::class);
    expect(fn() => $this->scalar->serialize('invalid'))->toThrow(\GraphQL\Error\InvariantViolation::class);
});

