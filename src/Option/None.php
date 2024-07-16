<?php

/** @noinspection ReturnTypeCanBeDeclaredInspection */

namespace Scheel\Rusty\Option;

use Scheel\Rusty\Exceptions\UnwrapException;

/**
 * @template T
 *
 * @implements Option<T>
 */
final readonly class None implements Option
{
    public function __construct() {}

    public function unwrap()
    {
        throw new UnwrapException('None cannot be unwrapped');
    }

    public function unwrapOr(mixed $default)
    {
        if (is_callable($default)) {
            return $default();
        }

        return $default;
    }

    public function isSome(): bool
    {
        return false;
    }

    public function isNone(): bool
    {
        return true;
    }
}
