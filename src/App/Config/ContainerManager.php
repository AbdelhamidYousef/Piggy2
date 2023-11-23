<?php

declare(strict_types=1);

namespace App\Config;

use App\Services\ValidatorService;
use Framework\{Framework, TemplateEngine};

abstract class ContainerManager
{
    public static function registerDefinitions(Framework $framework): void
    {
        $definitions = [
            TemplateEngine::class => fn () => new TemplateEngine(Config::VIEWS_BASE_PATH),
            ValidatorService::class => fn () => new ValidatorService(),
        ];

        $framework->addDefinitions($definitions);
    }
}
