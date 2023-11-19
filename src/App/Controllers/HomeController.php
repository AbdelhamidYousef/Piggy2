<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;

class HomeController
{
    public function __construct(private TemplateEngine $templateEngine)
    {
    }

    public function render(): void
    {
        echo $this->templateEngine->render('home.php', ['title' => 'Home']);
    }
}
