<?php

declare(strict_types=1);

namespace App\Config;

use Framework\{Framework, TemplateEngine};

class ContainerManager
{
    public static function registerDefinitions(Framework $framework): void
    {
        $definitions = [
            TemplateEngine::class => fn () => new TemplateEngine(Config::VIEWS_BASE_PATH),
        ];

        $framework->addDefinitions($definitions);
    }
}
