<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\ValidatorService;
use Framework\TemplateEngine;

class RegisterController
{
    public function __construct(
        private TemplateEngine $templateEngine,
        private ValidatorService $validatorService
    ) {
    }

    public function render(): void
    {
        echo $this->templateEngine->render('register.php', ['title' => 'Sign Up']);
    }

    public function register(): void
    {
        // [1] Validating the form data => by the controller
        // [2] Redirecting the user to the register page => by a middleware
        // [3] Displaying the errors & refilling the form => by a middleware

        $this->validatorService->validateRegister($_POST);
    }
}
