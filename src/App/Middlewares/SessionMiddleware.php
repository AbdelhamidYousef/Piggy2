<?php

declare(strict_types=1);

namespace App\Middlewares;

use Framework\Exceptions\SessionException;
use Framework\Interfaces\MiddlewareInterface;

class SessionMiddleware implements MiddlewareInterface
{
    public function process(callable $next): void
    {
        if (session_status() === PHP_SESSION_ACTIVE)
            throw new SessionException('Session is already started');
        if (headers_sent($filename, $line))
            throw new SessionException("Headers already sent in $filename on line $line");

        session_start();
        $next();
        session_write_close();
    }
}
