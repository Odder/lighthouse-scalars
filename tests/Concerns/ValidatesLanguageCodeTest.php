<?php

use Odder\LighthouseScalars\Concerns\ValidatesLanguageCode;

beforeEach(function () {
    $this->class = new class {
        use ValidatesLanguageCode;
    };
});

test('validates language codes correctly', function () {
    $validCodes = [
        'da', 'en', 'es', 'fr', 'de',
    ];

    foreach ($validCodes as $code) {
        expect($this->class->isValidLanguageCode($code))->toBeTrue();
    }
});

test('rejects invalid language codes', function () {
    $invalidCodes = [
        'XX', 'AAA', '', '123', 'xx', 'en-US',
    ];

    foreach ($invalidCodes as $code) {
        expect($this->class->isValidLanguageCode($code))->toBeFalse();
    }
});
