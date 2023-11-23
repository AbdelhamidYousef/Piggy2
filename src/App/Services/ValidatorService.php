<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Rules\EmailRule;
use Framework\Rules\InRule;
use Framework\Rules\MatchRule;
use Framework\Rules\MinRule;
use Framework\Rules\RequiredRule;
use Framework\Rules\UrlRule;
use Framework\Validator;

class ValidatorService
{
    private Validator $validator;


    public function __construct()
    {
        $this->validator = new Validator();

        $rules = [
            'email' => new EmailRule(),
            'in' => new InRule(),
            'match' => new MatchRule(),
            'min' => new MinRule(),
            'required' => new RequiredRule(),
            'url' => new UrlRule(),
        ];
        foreach ($rules as $ruleName => $instance) {
            $this->validator->addRule($ruleName, $instance);
        }
    }

    public function validateRegister($formData): void
    {
        $this->validator->validate(
            $formData,
            [
                'email' => ['required', 'email'],
                'age' => ['required',  'min:18'],
                'country' => ['required', 'in:USA,Canada,Mexico'],
                'socialMediaUrl' => ['required', 'url'],
                'password' => ['required'],
                'confirmPassword' => ['required', 'match:password'],
                'tos' => ['required'],
            ]
        );
    }
}
