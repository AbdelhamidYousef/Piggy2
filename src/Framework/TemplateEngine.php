<?php

declare(strict_types=1);

namespace Framework;

class TemplateEngine
{
    public function __construct(private string $basePath)
    {
    }

    public function render(string $view, array $data): string
    {
        extract($data, EXTR_SKIP);

        ob_start();
        include $this->basePath . $view;
        $output = ob_get_contents();
        ob_end_clean();

        return $output;
    }
}
