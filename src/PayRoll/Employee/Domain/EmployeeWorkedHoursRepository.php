<?php

declare(strict_types=1);

namespace IOET\Acme\PayRoll\Employee\Domain;

interface EmployeeWorkedHoursRepository 
{
    public function findAll(string $filename): array;

}