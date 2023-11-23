<?php

declare(strict_types=1);

namespace App\Middlewares;

use Framework\Exceptions\ValidationException;
use Framework\Interfaces\MiddlewareInterface;
use Framework\TemplateEngine;

class ValidationErrorsMiddleware implements MiddlewareInterface
{
    public function __construct(private TemplateEngine $templateEngine)
    {
    }

    public function process(callable $next): void
    {
        try {
            $next();
        } catch (ValidationException $e) {
            $oldFormData = $_POST;

            $excludedFields = ['password', 'confirmPassword'];
            $formattedformData = array_diff_key($oldFormData, array_flip($excludedFields));

            $_SESSION['errors'] = $e->errors;
            $_SESSION['oldData'] = $formattedformData;

            $referer = $_SERVER['HTTP_REFERER'];
            header("Location: $referer");
            http_response_code(302);
            exit();
        }
    }
}
