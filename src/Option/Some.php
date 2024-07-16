<?php

/** @noinspection ReturnTypeCanBeDeclaredInspection */

namespace Scheel\Rusty\Option;

/**
 * @template T
 *
 * @implements Option<T>
 */
final readonly class Some implements Option
{
    /**
     * @param  T  $value
     */
    public function __construct(
        private mixed $value
    ) {}

    public function unwrap()
    {
        return $this->value;
    }

    public function unwrapOr(mixed $default)
    {
        return $this->value;
    }

    public function isSome(): bool
    {
        return true;
    }

    public function isNone(): bool
    {
        return false;
    }
}
