<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Interfaces\RulesInterface;

class UrlRule implements RulesInterface
{
    public function validate(array $data, string $field, array $params): bool
    {
        return (bool) filter_var($data[$field], FILTER_VALIDATE_URL);
    }

    public function getMessage(array $data, string $field, array $params): string
    {
        return "This field must be a valid URL.";
    }
}
