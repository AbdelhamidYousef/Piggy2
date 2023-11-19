<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;

class AboutController
{
    public function __construct(private TemplateEngine $templateEngine)
    {
    }

    public function render()
    {
        echo $this->templateEngine->render('about.php', ['title' => 'About Page']);
    }
}
