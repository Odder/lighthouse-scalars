<?php

use Odder\LighthouseScalars\Scalars\Email;
use GraphQL\Language\AST\StringValueNode;

beforeEach(function () {
    $this->scalar = new Email();
});

test('validates correct email formats', function () {
    expect($this->scalar->parseValue('user@example.com'))->toBe('user@example.com');
    expect($this->scalar->parseValue('valid.email+alias@example.co.uk'))->toBe('valid.email+alias@example.co.uk');
});

test('rejects incorrect email formats', function () {
    $invalidEmails = [
        'invalid-email',
        'user@example',
        '@no-local-part.com',
        'user@.missing-domain',
        'user@domain..com'
    ];

    foreach ($invalidEmails as $email) {
        expect(fn() => $this->scalar->parseValue($email))->toThrow(GraphQL\Error\Error::class);
    }
});

test('serializes email addresses correctly', function () {
    $email = 'user@example.com';
    expect($this->scalar->serialize($email))->toBe($email);
});

test('parses values correctly', function () {
    $email = 'user@example.com';
    expect($this->scalar->parseValue($email))->toBe($email);
});

test('parses literal values correctly', function () {
    $email = 'user@example.com';
    $node = new StringValueNode(['value' => $email]);
    expect($this->scalar->parseLiteral($node, null))->toBe($email);
});