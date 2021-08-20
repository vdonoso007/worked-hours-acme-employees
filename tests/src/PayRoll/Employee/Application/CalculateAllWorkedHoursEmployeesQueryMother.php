<?php

namespace IOET\Acme\Tests\PayRoll\Employee\Application;

use IOET\Acme\PayRoll\Employee\Application\CalculateAllWorkedHoursEmployees\CalculateAllWorkedHoursEmployeesQuery;

class CalculateAllWorkedHoursEmployeesQueryMother
{

    public static function withFilename(): CalculateAllWorkedHoursEmployeesQuery
    {
        return new CalculateAllWorkedHoursEmployeesQuery("some-file-name");
    }
}