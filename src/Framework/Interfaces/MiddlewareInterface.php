<?php

declare(strict_types=1);

namespace Framework\Interfaces;

interface MiddlewareInterface
{
    public function process(callable $next): void;
}
