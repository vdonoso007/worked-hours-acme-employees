<?php

declare(strict_types = 1);

namespace IOET\Acme\PayRoll\Employee\Application\GetAllEmployeesName;

use IOET\Acme\PayRoll\Employee\Application\Response\GetAllEmployeesName\EmployeesNameResponse;
use IOET\Acme\Shared\Domain\Bus\Query\QueryHandler;

final class GetAllEmployeesNameQueryHandler implements QueryHandler
{

    private AllEmployeesNameFilter $filter;

    public function __construct(AllEmployeesNameFilter $filter)
    {
        $this->filter =  $filter;
    }

    public function __invoke(GetAllEmployeesNameQuery $query): EmployeesNameResponse
    {
        return $this->filter->filter($query->filename());
    }
}