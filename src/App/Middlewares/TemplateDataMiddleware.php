<?php

declare(strict_types=1);

namespace App\Middlewares;

use Framework\Interfaces\MiddlewareInterface;
use Framework\TemplateEngine;

class TemplateDataMiddleware implements MiddlewareInterface
{
    public function __construct(private TemplateEngine $templateEngine)
    {
    }

    public function process(callable $next): void
    {
        $this->templateEngine->addGlobal('title', 'Piggy Application');
        $next();
    }
}
