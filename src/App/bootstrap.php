<?php

declare(strict_types=1);

use Framework\Framework;
use function App\Config\registerRoutes;

$framework = new Framework();
registerRoutes($framework);
$framework->run();
