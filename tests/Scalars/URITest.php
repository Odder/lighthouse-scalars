<?php

use Odder\LighthouseScalars\Scalars\URI;
use GraphQL\Language\AST\StringValueNode;

beforeEach(function () {
    $this->scalar = new URI();
});

test('serializes valid URIs correctly', function () {
    $validUris = [
        'http://example.com',
        'https://example.com',
        'ftp://example.com',
        'mailto:user@example.com',
        'file:///path/to/file',
    ];

    foreach ($validUris as $uri) {
        expect($this->scalar->serialize($uri))->toBe($uri);
    }
});

test('rejects invalid URIs during serialization', function () {
    $invalidUris = [
        'http:///example.com', // Triple slash before domain is invalid
        'just-a-string',
        '://missing/scheme',
    ];

    foreach ($invalidUris as $uri) {
        expect(fn() => $this->scalar->serialize($uri))->toThrow(GraphQL\Error\Error::class);
    }
});

test('parses valid URIs correctly', function () {
    $validUris = [
        'http://example.com',
        'https://example.com',
        'ftp://example.com',
        'mailto:user@example.com',
        'file:///path/to/file',
    ];

    foreach ($validUris as $uri) {
        expect($this->scalar->parseValue($uri))->toBe($uri);
    }
});

test('rejects invalid URIs during parsing', function () {
    $invalidUris = [
        'http:///example.com', // Triple slash before domain is invalid
        'just-a-string',
        '://missing/scheme',
    ];

    foreach ($invalidUris as $uri) {
        expect(fn() => $this->scalar->parseValue($uri))->toThrow(GraphQL\Error\Error::class);
    }
});

test('parses literal values correctly', function () {
    $validUri = 'http://example.com';
    $node = new StringValueNode(['value' => $validUri]);
    expect($this->scalar->parseLiteral($node, null))->toBe($validUri);
});

test('rejects invalid literal values', function () {
    $invalidUri = '://missing/scheme';
    $node = new StringValueNode(['value' => $invalidUri]);
    expect(fn() => $this->scalar->parseLiteral($node, null))->toThrow(GraphQL\Error\Error::class);
});