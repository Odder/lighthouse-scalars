<?php

use Odder\LighthouseScalars\Concerns\ValidatesCountryCode;

beforeEach(function () {
    $this->class = new class {
        use ValidatesCountryCode;
    };
});

test('validates country codes correctly', function () {
    $validCodes = [
        'US', 'GB', 'CA',
    ];

    foreach ($validCodes as $code) {
        expect($this->class->isValidCountryCode($code))->toBeTrue();
    }
});

test('rejects invalid country codes', function () {
    $invalidCodes = [
        'XX', 'AAA', '', '123',
    ];

    foreach ($invalidCodes as $code) {
        expect($this->class->isValidCountryCode($code))->toBeFalse();
    }
});
