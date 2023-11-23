<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Interfaces\RulesInterface;

class EmailRule implements RulesInterface
{
    public function validate(array $data, string $field, array $params): bool
    {
        return (bool) filter_var($data[$field], FILTER_VALIDATE_EMAIL);
    }

    public function getMessage(array $data, string $field, array $params): string
    {
        return "This field must be a valid email address.";
    }
}
