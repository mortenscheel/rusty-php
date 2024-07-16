<?php

/** @noinspection PhpUnhandledExceptionInspection */

use Scheel\Rusty\Exceptions\UnwrapException;
use Scheel\Rusty\Option\None;
use Scheel\Rusty\Option\Option;
use Scheel\Rusty\Option\Some;

/**
 * @return Option<float>
 */
function toOption(?float $val): Option
{
    if ($val === null) {
        /** @var None<float> $option */
        $option = new None();
    } else {
        /** @var Some<float> $option */
        $option = new Some($val);
    }

    return $option;
}

test('can be none', function () {
    $option = toOption(null);
    expect($option)
        ->toBeInstanceOf(None::class)
        ->and($option->isNone())
        ->toBeTrue()
        ->and($option->isSome())
        ->toBeFalse();
});

test('can be some', function () {
    $option = toOption(42.0);
    expect($option)
        ->toBeInstanceOf(Some::class)
        ->and($option->isNone())
        ->toBeFalse()
        ->and($option->isSome())
        ->toBeTrue();
});

test('none cannot be unwrapped', function () {
    toOption(null)->unwrap();
})->throws(UnwrapException::class);

test('none can use unwrapOr()', function () {
    $option = toOption(null);
    expect($option->unwrapOr(3.14))->toBe(3.14)
        ->and($option->unwrapOr(fn () => 3.14))->toBe(3.14);
});

test('some can be unwrapped', function () {
    expect(toOption(42.0)->unwrap())->toBe(42.0);
});

test('some unwrapOr() ignores fallback', function () {
    expect(toOption(42.0)->unwrapOr(1.0))->toBe(42.0);
});
