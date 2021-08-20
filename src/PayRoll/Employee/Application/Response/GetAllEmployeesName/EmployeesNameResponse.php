<?php

declare(strict_types = 1);

namespace IOET\Acme\PayRoll\Employee\Application\Response\GetAllEmployeesName;

use IOET\Acme\Shared\Domain\Bus\Query\Response;

final class EmployeesNameResponse implements Response
{

    private array $names;

    public function __construct(EmployeeNameResponse ...$names)
    {
        $this->names = $names;
    }

    public function names(): array
    {
        return $this->names;
    }
}