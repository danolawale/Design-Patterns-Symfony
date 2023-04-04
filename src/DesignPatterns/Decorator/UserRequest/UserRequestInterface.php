<?php

namespace App\DesignPatterns\Decorator\UserRequest;

interface UserRequestInterface
{
    public function getRequestData(): array;
    public function validateFields(array $fields): void;
    public function getQuery(array $fields): string;
}
