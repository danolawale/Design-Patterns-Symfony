<?php

declare(strict_types=1);

namespace App\DesignPatterns\Decorator\UserRequestDetails;

use App\DesignPatterns\Decorator\UserRequest\UserRequestInterface;
use RuntimeException;

//Decorator needs to implement the interface and should also inject the interface in the constructor
class CreateUserDetails implements UserRequestInterface
{
    public function __construct(private array $userDetails, private UserRequestInterface $inner)
    {
    }

    public function getRequestData(): array
    {
        $baseFields = $this->inner->getRequestData();
        $validFields = array_merge([
            'name', 'email', 'username', 'role'
        ], array_keys($baseFields));
        $diff = array_diff(array_keys($this->userDetails), $validFields);
        if ($diff) {
            throw new RuntimeException(sprintf("The following fields are not expected: %s", implode(', ', $diff)));
        }

        return $this->userDetails + $baseFields;
    }

    public function validateFields(array $fields): void
    {
        $this->inner->validateFields($fields);
        if (!isset($fields['name'])) {
            throw new RuntimeException("User name must be set");
        }

        if (!isset($fields['email'])) {
            throw new RuntimeException("Email must be set");
        }

        if (!isset($fields['username'])) {
            throw new RuntimeException("Username must be set");
        }
    }

    public function getQuery(array $fields): string
    {
        return $this->inner->getQuery($fields);
    }
}
