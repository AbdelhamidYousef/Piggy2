<?php

declare(strict_types=1);

namespace App\Config;

use App\Middlewares\FlashErrorsMiddleware;
use App\Middlewares\SessionMiddleware;
use App\Middlewares\TemplateDataMiddleware;
use App\Middlewares\ValidationErrorsMiddleware;
use Framework\Framework;

abstract class MiddlewareManager
{
    private const middlewares = [
        TemplateDataMiddleware::class,
        FlashErrorsMiddleware::class,
        ValidationErrorsMiddleware::class,
        SessionMiddleware::class,
    ];

    public static function registerMiddlewares(Framework $framework): void
    {
        $framework->addMiddlewares(self::middlewares);
    }
}
