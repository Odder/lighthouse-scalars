<?php

use Odder\LighthouseScalars\Scalars\URL;
use GraphQL\Language\AST\StringValueNode;

beforeEach(function () {
    $this->scalar = new URL();
});

test('serializes valid URLs correctly', function () {
    $validUrls = [
        'http://example.com',
        'https://example.com',
        'https://www.example.com/path?query=string#fragment',
    ];

    foreach ($validUrls as $url) {
        expect($this->scalar->serialize($url))->toBe($url);
    }
});

test('rejects invalid URLs during serialization', function () {
    $invalidUrls = [
        'ftp://example.com',
        'http:///example.com',
        'just-a-string',
        'www.example.com',
    ];

    foreach ($invalidUrls as $url) {
        expect(fn() => $this->scalar->serialize($url))->toThrow(GraphQL\Error\Error::class);
    }
});

test('parses valid URLs correctly', function () {
    $validUrls = [
        'http://example.com',
        'https://example.com',
        'https://www.example.com/path?query=string#fragment',
    ];

    foreach ($validUrls as $url) {
        expect($this->scalar->parseValue($url))->toBe($url);
    }
});

test('rejects invalid URLs during parsing', function () {
    $invalidUrls = [
        'ftp://example.com',
        'http:///example.com',
        'just-a-string',
        'www.example.com',
    ];

    foreach ($invalidUrls as $url) {
        expect(fn() => $this->scalar->parseValue($url))->toThrow(GraphQL\Error\Error::class);
    }
});

test('parses literal values correctly', function () {
    $validUrl = 'https://example.com';
    $node = new StringValueNode(['value' => $validUrl]);
    expect($this->scalar->parseLiteral($node, null))->toBe($validUrl);
});

test('rejects invalid literal values', function () {
    $invalidUrl = 'ftp://example.com';
    $node = new StringValueNode(['value' => $invalidUrl]);
    expect(fn() => $this->scalar->parseLiteral($node, null))->toThrow(GraphQL\Error\Error::class);
});