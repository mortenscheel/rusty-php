<?php

/** @noinspection PhpMissingReturnTypeInspection */

/** @noinspection ReturnTypeCanBeDeclaredInspection */

namespace Scheel\Rusty\Result;

use Exception;
use Scheel\Rusty\Option\None;
use Scheel\Rusty\Option\Option;
use Scheel\Rusty\Option\Some;

/**
 * @template E of Exception
 *
 * @implements Result<void, E>
 */
final readonly class Err implements Result
{
    /**
     * @param  E  $error
     */
    public function __construct(
        private mixed $error
    ) {}

    /**
     * @return void
     *
     * @throws E
     */
    public function unwrap()
    {
        throw $this->error;
    }

    public function unwrapOr(mixed $fallback)
    {
        if (is_callable($fallback)) {
            // @phpstan-ignore return.void, callable.void
            return $fallback();
        }

        // @phpstan-ignore return.void
        return $fallback;
    }

    public function isOk(): bool
    {
        return false;
    }

    public function isErr(): bool
    {
        return true;
    }

    public function ok(): Option
    {
        return new None();
    }

    public function err(): Option
    {
        return new Some($this->error);
    }
}
