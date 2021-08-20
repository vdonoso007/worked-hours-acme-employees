<?php

declare(strict_types=1);

namespace IOET\Acme\PayRoll\Employee\Domain\Entity;

use IOET\Acme\PayRoll\Employee\Domain\ValueObject\EmployeeDayWorked;
use IOET\Acme\PayRoll\Employee\Domain\ValueObject\EmployeeId;
use IOET\Acme\PayRoll\Employee\Domain\ValueObject\EmployeeName;
use IOET\Acme\PayRoll\Employee\Domain\ValueObject\EmployeeTimeRange;

final class EmployeeWorkedHours
{
    private EmployeeName $name;
    private EmployeeTimeRange $timeRangeWorked;

    public function __construct(
        EmployeeName $name,
        EmployeeTimeRange $timeRangeWorked
    )
    {
        $this->name = $name;
        $this->timeRangeWorked = $timeRangeWorked;
    }

    public function name(): EmployeeName
    {
        return $this->name;
    }

    public function timeRangeWorked(): EmployeeTimeRange
    {
        return $this->timeRangeWorked;
    }
}