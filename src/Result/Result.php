<?php

namespace Scheel\Rusty\Result;

use Scheel\Rusty\Exceptions\UnwrapException;
use Scheel\Rusty\Option\Option;

/**
 * @template T
 * @template E
 */
interface Result
{
    /**
     * @return T
     *
     * @throws E
     * @phpstan-ignore throws.notThrowable
     */
    public function unwrap();

    /**
     * @param  callable():T|T  $fallback
     * @return T
     */
    public function unwrapOr(mixed $fallback);

    public function isOk(): bool;

    public function isErr(): bool;

    /**
     * @return Option<T>
     */
    public function ok(): Option;

    /**
     * @return Option<E>
     */
    public function err(): Option;
}
