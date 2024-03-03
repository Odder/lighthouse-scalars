<?php

use Odder\LighthouseScalars\Concerns\ValidatesCurrencyCode;

beforeEach(function () {
    $this->class = new class {
        use ValidatesCurrencyCode;
    };
});

test('validates currency codes correctly', function () {
    $validCodes = [
        'DKK', 'USD', 'EUR', 'JPY', 'GBP',
    ];

    foreach ($validCodes as $code) {
        expect($this->class->isValidCurrencyCode($code))->toBeTrue();
    }
});

test('rejects invalid currency codes', function () {
    $invalidCodes = [
        'XXX', 'US', 'EURO', '123',
    ];

    foreach ($invalidCodes as $code) {
        expect($this->class->isValidCurrencyCode($code))->toBeFalse();
    }
});
