<?php

namespace IOET\Acme\Tests\PayRoll\Employee\Infrastructure;

use IOET\Acme\PayRoll\Employee\Application\GetAllEmployeesName\AllEmployeesNameFilter;
use IOET\Acme\PayRoll\Employee\Application\GetRateByWorkedHoursReported\RateByWorkedHoursReportedGetter;
use IOET\Acme\Shared\Infrastructure\TextFile\TextFileRepository;

use IOET\Acme\PayRoll\Employee\Domain\Entity\EmployeeWorkedHours;
use IOET\Acme\PayRoll\Employee\Domain\ValueObject\EmployeeName;
use IOET\Acme\PayRoll\Employee\Domain\ValueObject\EmployeeTimeRange;
use IOET\Acme\PayRoll\Employee\Infrastructure\RateWorkedHoursRepository;
use IOET\Acme\PayRoll\Employee\Infrastructure\TextFileEmployeeWorkedHoursRepository;


class TextFileObjectMother extends TextFileRepository
{

    public function loadFile(string $filename): array
    {
        $repository = new TextFileEmployeeWorkedHoursRepository();
        $data = $repository->findAll($filename);
        
        /*print(" \n");
        foreach($data as $item)
        {
            print($item->name()->value()." - ".$item->timeRangeWorked()->dayOfWeek()." - ".$item->timeRangeWorked()->from()." - ".$item->timeRangeWorked()->to()." \n");
        }*/
        
        return $data;
    }

    public function getAllEmployees(string $filename): array
    {
        $repository = new TextFileEmployeeWorkedHoursRepository();
        $filter = new AllEmployeesNameFilter($repository);
        $responses = $filter->filter($filename);

        /*print(" \n");
        foreach($responses->names() as $item)
        {
            print($item->name()." \n");
        }*/
        
        return $responses->names();
    }

    public function getRateByWorkedHoursReportedPerEmployee(string $day, string $from, string $to): array
    {
        $getterRate = new RateByWorkedHoursReportedGetter( new RateWorkedHoursRepository);
        $response = $getterRate->__invoke($day, $from, $to);
        /*print(" \n");
        print_r($response);*/
        
        return $response;
    }
}