<?php

declare(strict_types=1);

namespace IOET\Acme\PayRoll\Employee\Application\SearchAllWorkedHoursEmployees;

use IOET\Acme\PayRoll\Employee\Application\Response\AllWorkedHoursEmployeesResponse;
use IOET\Acme\Shared\Domain\Bus\Query\QueryHandler;
use IOET\Acme\PayRoll\Employee\Application\SearchAllWorkedHoursEmployees\SearchAllWorkedHoursEmployeesQuery;

final class SearchAllWorkedHoursEmployeesQueryHandler implements QueryHandler
{

    private AllWorkedHoursEmployeesSearcher $searcher;

    public function __construct(AllWorkedHoursEmployeesSearcher $searcher)
    {
        $this->searcher = $searcher;
    }

    public function __invoke(SearchAllWorkedHoursEmployeesQuery $query): AllWorkedHoursEmployeesResponse
    {
        return $this->searcher->searchAll($query->filename());
    }
}