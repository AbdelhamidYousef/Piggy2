<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Interfaces\RulesInterface;

class InRule implements RulesInterface
{
    public function validate(array $data, string $field, array $params): bool
    {
        return in_array($data[$field], $params, true);
    }

    public function getMessage(array $data, string $field, array $params): string
    {
        return "Please select a valid value. Valid values are: " . implode(", ", $params);
    }
}
