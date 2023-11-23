<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Interfaces\RulesInterface;

class MinRule implements RulesInterface
{
    public function validate(array $data, string $field, array $params): bool
    {
        return $data[$field] >= $params[0];
    }

    public function getMessage(array $data, string $field, array $params): string
    {
        return "This field must be greater than $params[0].";
    }
}
