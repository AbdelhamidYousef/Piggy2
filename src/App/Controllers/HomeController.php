<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Config\Config;
use Framework\TemplateEngine;

class HomeController
{
    private TemplateEngine $templateEngine;

    public function __construct()
    {
        $this->templateEngine = new TemplateEngine(Config::VIEWS_BASE_PATH);
    }

    public function render(): void
    {
        echo $this->templateEngine->render('home.php', ['title' => 'Home']);
    }
}
