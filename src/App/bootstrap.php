<?php

declare(strict_types=1);

use App\Controllers\HomeController;
use Framework\Framework;

$framework = new Framework();
$framework->get('/', 'GET', [HomeController::class, 'render']);
$framework->run();
