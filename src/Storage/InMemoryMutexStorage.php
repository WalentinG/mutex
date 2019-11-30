<?php

/**
 * PHP Mutex implementation.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\Mutex\Storage;

/**
 * @internal
 */
final class InMemoryMutexStorage
{
    /**
     * @psalm-var array<string, bool>
     */
    private array

 $localStorage = [];

    private static ?self $instance;

    /**
     * @return self
     */
    public static function instance(): self
    {
        if (false === isset(self::$instance))
        {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function lock(string $key): void
    {
        $this->localStorage[$key] = true;
    }

    public function has(string $key): bool
    {
        return isset($this->localStorage[$key]);
    }

    public function unlock(string $key): void
    {
        unset($this->localStorage[$key]);
    }

    /**
     * Reset instance.
     */
    public function reset(): void
    {
        self::$instance = null;
    }

    /**
     * @codeCoverageIgnore
     */
    private function __clone()
    {
    }

    /**
     * @codeCoverageIgnore
     */
    private function __construct()
    {
    }
}
