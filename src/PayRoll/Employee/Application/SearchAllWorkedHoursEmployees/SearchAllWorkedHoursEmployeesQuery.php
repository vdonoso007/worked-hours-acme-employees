<?php

declare(strict_types=1);

namespace IOET\Acme\PayRoll\Employee\Application\SearchAllWorkedHoursEmployees;

use IOET\Acme\Shared\Domain\Bus\Query\Query;

final class SearchAllWorkedHoursEmployeesQuery implements Query
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