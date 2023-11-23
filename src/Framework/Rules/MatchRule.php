<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Interfaces\RulesInterface;

class MatchRule implements RulesInterface
{
    public function validate(array $data, string $field, array $params): bool
    {
        return $data[$field] === $data[$params[0]];
    }

    public function getMessage(array $data, string $field, array $params): string
    {
        return "This field must match the $params[0] field.";
    }
}
