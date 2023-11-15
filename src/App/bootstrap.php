<?php

declare(strict_types=1);

use App\Config\RouterManager;
use Framework\Framework;

$framework = new Framework();
RouterManager::registerRoutes($framework);
$framework->run();
