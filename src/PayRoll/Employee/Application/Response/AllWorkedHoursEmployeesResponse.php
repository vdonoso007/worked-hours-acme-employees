<?php

declare(strict_types=1);

namespace IOET\Acme\PayRoll\Employee\Application\Response;

use IOET\Acme\Shared\Domain\Bus\Query\Response;

final class AllWorkedHoursEmployeesResponse implements Response
{

    private array $workedHours;

    public function __construct(AllWorkedHoursEmployeeResponse ...$workedHours)
    {
        $this->workedHours = $workedHours;
    }

    public function workedHours(): array
    {
        return $this->workedHours;
    }
}