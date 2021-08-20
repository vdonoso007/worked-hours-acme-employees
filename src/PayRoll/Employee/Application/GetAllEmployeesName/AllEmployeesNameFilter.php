<?php

declare(strict_types = 1);

namespace IOET\Acme\PayRoll\Employee\Application\GetAllEmployeesName;

use IOET\Acme\PayRoll\Employee\Application\Response\GetAllEmployeesName\EmployeeNameResponse;
use IOET\Acme\PayRoll\Employee\Application\Response\GetAllEmployeesName\EmployeesNameResponse;
use IOET\Acme\PayRoll\Employee\Domain\EmployeeWorkedHoursRepository;
use IOET\Acme\PayRoll\Employee\Domain\Entity\EmployeeWorkedHours;
use function Lambdish\Phunctional\map;

final class AllEmployeesNameFilter
{

    private EmployeeWorkedHoursRepository $repository;

    public function __construct(EmployeeWorkedHoursRepository $repository)
    {
        $this->repository = $repository;
    }

    public function filter(string $filename): EmployeesNameResponse
    {
        $result = array();
        $data = $this->repository->findAll($filename);
        foreach($data as $item)
        {
            if (!in_array($item->name()->value(), $result, TRUE))
            {
                $result[] = $item->name()->value();
            }
        }
        return new EmployeesNameResponse( ...map($this->toResponse(), $result) );
    }

    private function toResponse(): callable
    {
        return static fn($item) => new EmployeeNameResponse($item);
    }

}