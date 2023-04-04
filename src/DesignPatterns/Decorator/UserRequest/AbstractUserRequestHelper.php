<?php

declare(strict_types=1);

namespace App\DesignPatterns\Decorator\UserRequest;

abstract class AbstractUserRequestHelper
{
    protected const TABLE = 'user';
    protected function getPrimaryIdentifier(): string
    {
        return 'id';
    }
}
