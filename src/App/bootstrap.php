<?php

declare(strict_types=1);

use App\Config\{RouterManager, ContainerManager};
use Framework\Framework;

$framework = new Framework();

RouterManager::registerRoutes($framework);
ContainerManager::registerDefinitions($framework);

$framework->run();
