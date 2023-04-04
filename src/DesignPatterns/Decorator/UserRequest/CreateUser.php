<?php

declare(strict_types=1);

namespace App\DesignPatterns\Decorator\UserRequest;

use DateTimeImmutable;
use DateTimeInterface;
use RuntimeException;

class CreateUser extends AbstractUserRequestHelper implements UserRequestInterface
{
    public const DEFAULT_PASSWORD = 'password123';
    public function getRequestData(): array
    {
        $datetime = new DateTimeImmutable();
        return [
            'created_at' => $datetime->format(DateTimeInterface::RFC3339),
            'modified_at' => $datetime->format(DateTimeInterface::RFC3339),
            'created_by' => 'admin user',
            'modified_by' => 'admin user',
            'default_password' => self::DEFAULT_PASSWORD,
            'is_admin' => 0
        ];
    }

    public function validateFields(array $fields): void
    {
        $diff = array_diff(
            ['created_at', 'created_by', 'default_password', 'modified_at', 'modified_by'],
            array_keys($fields)
        );

        if (!empty($diff)) {
            throw new RuntimeException(sprintf("Required field(s) '%s' was not provided.", implode('', $diff)));
        }
    }

    public function getQuery(array $fields): string
    {
        $primaryId = $this->getPrimaryIdentifier();
        unset($fields[$primaryId]);
        $query = "INSERT INTO " . self::TABLE . "(" . implode(', ', array_keys($fields)) . ") VALUE (";
        foreach ($fields as $value) {
            $query .= "$value, ";
        }

        $query = rtrim($query, ', ');
        $query .= ");";
        return $query;
    }
}
