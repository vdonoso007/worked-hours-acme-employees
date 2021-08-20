<?php

declare(strict_types=1);

namespace IOET\Acme\PayRoll\Employee\Application\SearchAllWorkedHoursEmployees;

use IOET\Acme\PayRoll\Employee\Application\Response\AllWorkedHoursEmployeeResponse;
use IOET\Acme\PayRoll\Employee\Application\Response\AllWorkedHoursEmployeesResponse;
use IOET\Acme\PayRoll\Employee\Domain\EmployeeWorkedHoursRepository;
use IOET\Acme\PayRoll\Employee\Domain\Entity\EmployeeWorkedHours;

use function Lambdish\Phunctional\map;

final class AllWorkedHoursEmployeesSearcher
{

    private EmployeeWorkedHoursRepository $repository;

    public function __construct(EmployeeWorkedHoursRepository $repository)
    {
        $this->repository = $repository;
    }

    public function searchAll(string $filename): AllWorkedHoursEmployeesResponse
    {

        return new AllWorkedHoursEmployeesResponse(...map($this->toResponse(), $this->repository->findAll($filename)));
    }

    private function toResponse(): callable
    {
        return static fn(EmployeeWorkedHours $workedHour) => new AllWorkedHoursEmployeeResponse(
            $workedHour->name()->value(),
            $workedHour->timeRangeWorked()->dayOfWeek(),
            $workedHour->timeRangeWorked()->from(),
            $workedHour->timeRangeWorked()->to()
        );
    }
}