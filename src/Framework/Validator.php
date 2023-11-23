<?php

declare(strict_types=1);

namespace Framework;

use Exception;
use Framework\Exceptions\RuleException;
use Framework\Exceptions\ValidationException;
use Framework\Interfaces\RulesInterface;

class Validator
{
    private array $rules = [];

    public function addRule(string $ruleName, RulesInterface $ruleInstance): void
    {
        $this->rules[$ruleName] = $ruleInstance;
    }

    public function validate($data, $fieldsRules): void
    {
        $errors = [];

        foreach ($fieldsRules as $field => $rules) {
            foreach ($rules as $rule) {
                // [1] Get the rule name & parameters
                $params = [];
                if (str_contains($rule, ':')) {
                    [$rule, $params] = explode(':', $rule);
                    $params = explode(',', $params);
                }

                // [2] Validate the rule, then get the rule instance
                if (!array_key_exists($rule, $this->rules))
                    throw new RuleException("Rule $rule isn't valid. Please make sure to provide a valid rule");

                $ruleInstance = $this->rules[$rule];

                // [3] Validate the field
                if ($ruleInstance->validate($data, $field, $params)) continue;

                $errors[$field][] = $ruleInstance->getMessage($data, $field, $params);
            }
        }

        if (count($errors)) throw new ValidationException($errors);
    }
}
