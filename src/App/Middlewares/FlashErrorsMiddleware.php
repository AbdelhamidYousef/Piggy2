<?php

declare(strict_types=1);

namespace App\Middlewares;

use Framework\Interfaces\MiddlewareInterface;
use Framework\TemplateEngine;

class FlashErrorsMiddleware implements MiddlewareInterface
{
    public function __construct(private TemplateEngine $templateEngine)
    {
    }

    public function process(callable $next): void
    {
        $this->templateEngine->addGlobal('errors', $_SESSION['errors'] ?? []);
        $this->templateEngine->addGlobal('oldData', $_SESSION['oldData'] ?? []);

        unset($_SESSION['errors']);
        unset($_SESSION['oldData']);

        $next();
    }
}
