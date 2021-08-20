<?php

declare(strict_types=1);

namespace IOET\Acme\PayRoll\Employee\Application\CalculateAllWorkedHoursEmployees;

use IOET\Acme\PayRoll\Employee\Application\Response\SummaryPayRoll\PayRollListResponse;
use IOET\Acme\Shared\Domain\Bus\Query\QueryHandler;

final class CalculateAllWorkedHoursEmployeesQueryHandler implements QueryHandler
{

    private AllWorkedHoursEmployeesCalculator $calculator;

    public function __construct(AllWorkedHoursEmployeesCalculator $calculator)
    {
        $this->calculator = $calculator;
    }

    public function __invoke(CalculateAllWorkedHoursEmployeesQuery $query): PayRollListResponse
    {
        return $this->calculator->calculate($query->filename());
    }
}