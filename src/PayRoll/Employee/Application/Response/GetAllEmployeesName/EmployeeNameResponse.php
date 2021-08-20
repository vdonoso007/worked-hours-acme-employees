<?php

declare(strict_types = 1);

namespace IOET\Acme\PayRoll\Employee\Application\Response\GetAllEmployeesName;

use IOET\Acme\Shared\Domain\Bus\Query\Response;

final class EmployeeNameResponse implements Response
{

    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function name(): string
    {
        return $this->name;
    }
}