<?php

namespace Scheel\Rusty\Option;

use Scheel\Rusty\Exceptions\UnwrapException;

/** @template T */
interface Option
{
    /**
     * @return T
     *
     * @throws UnwrapException
     */
    public function unwrap();

    /**
     * @param  callable():T|T  $fallback
     * @return T
     * @throws UnwrapException
     */
    public function unwrapOr(mixed $fallback);

    public function isSome(): bool;

    public function isNone(): bool;
}
