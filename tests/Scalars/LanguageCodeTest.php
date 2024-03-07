<?php

use Odder\LighthouseScalars\Scalars\LanguageCode;
use GraphQL\Language\AST\StringValueNode;
use GraphQL\Error\Error;

beforeEach(function () {
    $this->scalar = new LanguageCode();
});

test('validates correct ISO 639-1 codes', function () {
    $validCodes = ['en', 'fr', 'de'];
    foreach ($validCodes as $code) {
        expect($this->scalar->serialize($code))->toBe(strtolower($code));
        expect($this->scalar->parseValue($code))->toBe(strtolower($code));
        $nodeValue = new StringValueNode(['value' => $code]);
        expect($this->scalar->parseLiteral($nodeValue, null))->toBe(strtolower($code));
    }
});

test('throws error for invalid ISO 639-1 codes', function () {
    $invalidCodes = ['eng', 'f', '123', 'xx'];
    foreach ($invalidCodes as $code) {
        $nodeValue = new StringValueNode(['value' => $code]);
        expect(fn() => $this->scalar->serialize($code))->toThrow(\GraphQL\Error\InvariantViolation::class);
        expect(fn() => $this->scalar->parseValue($code))->toThrow(Error::class);
        expect(fn() => $this->scalar->parseLiteral($nodeValue, null))->toThrow(Error::class);
    }
});