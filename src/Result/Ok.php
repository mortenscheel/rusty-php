<?php

namespace Scheel\Rusty\Result;

use Exception;
use Scheel\Rusty\Option\None;
use Scheel\Rusty\Option\Option;
use Scheel\Rusty\Option\Some;

/**
 * @template T
 *
 * @implements Result<T, void>
 */
final readonly class Ok implements Result
{
    /**
     * @param  T  $val
     */
    public function __construct(
        private mixed $val
    ) {}

    /**
     * @return T
     */
    public function unwrap()
    {
        return $this->val;
    }

    public function unwrapOr(mixed $fallback)
    {
        return $this->val;
    }

    public function isOk(): bool
    {
        return true;
    }

    public function isErr(): bool
    {
        return false;
    }

    public function ok(): Option
    {
        return new Some($this->val);
    }

    public function err(): Option
    {
        return new None();
    }
}
