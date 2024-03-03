<?php

use Odder\LighthouseScalars\Scalars\Emoji;
use GraphQL\Error\Error;

test('validates single emoji correctly', function () {
    $emojiScalar = new Emoji();

    $validEmoji = '😊';
    expect($emojiScalar->serialize($validEmoji))->toBe($validEmoji);
    expect($emojiScalar->parseValue($validEmoji))->toBe($validEmoji);

    $emojiLiteral = new \GraphQL\Language\AST\StringValueNode([]);
    $emojiLiteral->value = $validEmoji;
    expect($emojiScalar->parseLiteral($emojiLiteral))->toBe($validEmoji);
});

test('throws error for invalid emoji input', function () {
    $emojiScalar = new Emoji();

    $invalidEmoji = 'Hello 😊';
    $emojiScalar->serialize($invalidEmoji);
})->throws(Error::class);

test('throws error for non-emoji input', function () {
    $emojiScalar = new Emoji();

    $nonEmoji = 'Hello';
    $emojiScalar->serialize($nonEmoji);
})->throws(Error::class);
