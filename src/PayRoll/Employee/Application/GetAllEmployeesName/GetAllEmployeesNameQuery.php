<?php

declare(strict_types = 1);

namespace IOET\Acme\PayRoll\Employee\Application\GetAllEmployeesName;

use IOET\Acme\Shared\Domain\Bus\Query\Query;

final class GetAllEmployeesNameQuery implements Query
{

    private string $filename;

    public function __construct(array $employeesWorkedHours)
    {
        $this->employeesWorkedHours = $employeesWorkedHours;
    }

    public function filename(): string
    {
        return $this->filename;
    }
}