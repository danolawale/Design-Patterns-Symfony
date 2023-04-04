<?php

declare(strict_types=1);

namespace App\DesignPatterns\Decorator;

use App\DesignPatterns\Decorator\UserRequestDetails\CreateUserDetails;
use App\DesignPatterns\Decorator\UserRequestDetails\UpdateUserDetails;
use App\DesignPatterns\Decorator\UserRequest\CreateUser;
use App\DesignPatterns\Decorator\UserRequest\UserRequestInterface;
use App\DesignPatterns\Decorator\UserRequest\UpdateUser;
use RuntimeException;

class UserRequestDecoratorFactory
{
    public function __invoke(array $userDetails, string $action): UserRequestInterface
    {
        return match ($action) {
            'create' => new CreateUserDetails($userDetails, new CreateUser()),
            'update' => new UpdateUserDetails($userDetails, new UpdateUser()),
            default => throw new RuntimeException(
                sprintf("'%s' is not a supported action. App currently only support create or update actions.")
            )
        };
    }
}
