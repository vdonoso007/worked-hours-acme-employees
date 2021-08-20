<?php

declare(strict_types=1);

namespace IOET\Acme\PayRoll\Employee\Application\CalculateAllWorkedHoursEmployees;

use IOET\Acme\Shared\Domain\Bus\Query\Query;

final class CalculateAllWorkedHoursEmployeesQuery implements Query
{

    private string $filename;

    public function __construct(string $filename)
    {
        $this->filename = $filename;
    }

    public function filename(): string
    {
        return $this->filename;
    }
}