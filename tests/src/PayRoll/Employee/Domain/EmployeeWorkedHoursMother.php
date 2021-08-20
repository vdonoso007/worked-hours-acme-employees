<?php

namespace IOET\Acme\Tests\PayRoll\Employee\Domain;

use IOET\Acme\PayRoll\Employee\Domain\Entity\EmployeeWorkedHours;

final class EmployeeWorkedHoursMother
{

    public static function random(): EmployeeWorkedHours
    {
        return new EmployeeWorkedHours(
                                        EmployeeNameMother::someName(),
                                        EmployeeTimeRangeMother::create("MO", "10:00", "12:00")
        );
    }

    public static function randomSerializedArray(): array
    {
        $employee = self::random();

        return [
            'employee' => $employee->name()->value(),
            'dayWorked' => $employee->timeRangeWorked()->dayOfWeek(),
            'timeFrom' => $employee->timeRangeWorked()->from(),
            'timeTo' => $employee->timeRangeWorked()->to()
        ];
    }
}