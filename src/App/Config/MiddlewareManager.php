<?php

declare(strict_types=1);

namespace App\Config;

use App\Middlewares\TemplateDataMiddleware;
use Framework\Framework;

abstract class MiddlewareManager
{
    private const middlewares = [
        TemplateDataMiddleware::class
    ];

    public static function registerMiddlewares(Framework $framework): void
    {
        $framework->addMiddlewares(self::middlewares);
    }
}
