<?php

declare(strict_types=1);

namespace Framework;

class TemplateEngine
{
    private array $globalData = [];

    public function __construct(private string $basePath)
    {
    }

    public function render(string $view, array $data = []): string
    {
        extract($data, EXTR_SKIP);
        extract($this->globalData, EXTR_SKIP);

        ob_start();
        include $this->basePath . $view;
        $output = ob_get_contents();
        ob_end_clean();

        return $output;
    }

    public function addGlobal(string $key, string $value): void
    {
        $this->globalData[$key] = $value;
    }
}
