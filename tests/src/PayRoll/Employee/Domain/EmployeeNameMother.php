<?php

declare(strict_types=1);

namespace IOET\Acme\Tests\PayRoll\Employee\Domain;

use IOET\Acme\PayRoll\Employee\Domain\ValueObject\EmployeeName;

final class EmployeeNameMother
{

    public static function someName(): EmployeeName
    {
        return new EmployeeName("Some employee name");
    }
}