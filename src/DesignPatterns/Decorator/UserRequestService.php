<?php

declare(strict_types=1);

namespace App\DesignPatterns\Decorator;

class UserRequestService
{
    public function __construct(private readonly UserRequestDecoratorFactory $decoratorFactory)
    {
    }

    public function request(array $userDetails, string $action): string
    {
        $decorator = ($this->decoratorFactory)($userDetails, $action);
        $requestData = $decorator->getRequestData();
        $decorator->validateFields($requestData);
        return $decorator->getQuery($requestData);
    }
}
