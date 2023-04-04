<?php

declare(strict_types=1);

namespace App\DesignPatterns\Decorator\UserRequest;

use DateTimeImmutable;
use DateTimeInterface;
use RuntimeException;

class UpdateUser extends AbstractUserRequestHelper implements UserRequestInterface
{
    public function getRequestData(): array
    {
        $datetime = new DateTimeImmutable();
        return [
            'modified_at' => $datetime->format(DateTimeInterface::RFC3339),
            'modified_by' => 'admin user',
            'is_admin' => 0
        ];
    }

    public function validateFields(array $fields): void
    {
        $diff = array_diff(['modified_at', 'modified_by', 'is_admin'], array_keys($fields));
        if (!empty($diff)) {
            throw new RuntimeException(sprintf("Required field(s) '%s' was not provided.", implode('', $diff)));
        }
    }

    public function getQuery(array $fields): string
    {
        $primaryId = $this->getPrimaryIdentifier();
        $primaryIdValue = $fields[$primaryId] ?? null;
        if ($primaryIdValue === null) {
            throw new RuntimeException("The primary ID of the table must be provided");
        }

        unset($fields[$primaryId]);
        $query = "UPDATE " . self::TABLE . " SET ";
        foreach ($fields as $field => $value) {
            $query .= "$field = $value, ";
        }

        $query = rtrim($query, ',');
        $query .= " WHERE $primaryId = $primaryIdValue";
        return $query;
    }
}
