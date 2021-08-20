<?php

namespace IOET\Acme\Tests\PayRoll\Employee\Domain;

use IOET\Acme\PayRoll\Employee\Domain\ValueObject\EmployeeTimeRange;

final class EmployeeTimeRangeMother
{

    public static function create(string $day, string $timeFrom, string $timeTo): EmployeeTimeRange
    {
        return new EmployeeTimeRange($day, $timeFrom, $timeTo);
    }
}