<?php

declare(strict_types=1);

use App\Config\{RouterManager, ContainerManager, MiddlewareManager};
use Framework\Framework;

$framework = new Framework();

RouterManager::registerRoutes($framework);
ContainerManager::registerDefinitions($framework);
MiddlewareManager::registerMiddlewares($framework);

$framework->run();
