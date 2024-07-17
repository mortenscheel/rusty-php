<?php

/** @noinspection PhpUnhandledExceptionInspection */

use Scheel\Rusty\Option\None;
use Scheel\Rusty\Option\Some;
use Scheel\Rusty\Result\Err;
use Scheel\Rusty\Result\Ok;
use Scheel\Rusty\Result\Result;

/**
 * @return Result<float, Exception>
 */
function toResult(?float $val = null, ?Exception $error = null): Result
{
    if ($error !== null) {
        /** @var Err<float, Exception> $option */
        $result = new Err($error);
    } elseif ($val !== null) {
        /** @var Ok<float, Exception> $option */
        $result = new Ok($val);
    } else {
        throw new RuntimeException('val or error must be provided');
    }

    return $result;
}

test('ok can be unwrapped', function () {
    $result = toResult(val: 3.2);
    expect($result)
        ->toBeInstanceOf(Ok::class)
        ->and($result->unwrap())
        ->toBe(3.2);
});
test('err fails when unwrapped', function () {
    toResult(error: new RuntimeException('Failed'))->unwrap();
})->throws(
    exception: RuntimeException::class,
    exceptionMessage: 'Failed'
);
test('ok ok() is Some and err() is None', function () {
    $result = toResult(val: 3.2);
    expect($result->ok())
        ->toBeInstanceOf(Some::class)
        ->and($result->ok()->unwrap())
        ->toBe(3.2)
        ->and($result->err())
        ->toBeInstanceOf(None::class);
});
test('err ok() is None and err() is Some', function () {
    $result = toResult(error: new InvalidArgumentException('Nope!'));
    expect($result->ok())
        ->toBeInstanceOf(None::class)
        ->and($result->err())
        ->toBeInstanceOf(Some::class)
        ->and($result->err()->unwrap())
        ->toBeInstanceOf(InvalidArgumentException::class);
});

test('err unwrapOr() returns fallback', function () {
    expect(
        toResult(error: new RuntimeException())->unwrapOr(1.1)
    )->toBe(1.1);
});

test('ok unwrapOr() ignores fallback', function () {
    expect(
        toResult(val: 42.0)->unwrapOr(24.5)
    )->toBe(42.0);
});
