<?php

declare(strict_types=1);

namespace IOET\Acme\PayRoll\Employee\Application\CalculateAllWorkedHoursEmployees;

use IOET\Acme\PayRoll\Employee\Application\GetAllEmployeesName\AllEmployeesNameFilter;
use IOET\Acme\PayRoll\Employee\Application\GetRateByWorkedHoursReported\RateByWorkedHoursReportedGetter;
use IOET\Acme\PayRoll\Employee\Application\Response\AllWorkedHoursEmployeeResponse;
use IOET\Acme\PayRoll\Employee\Application\Response\SummaryPayRoll\PayRollListResponse;
use IOET\Acme\PayRoll\Employee\Application\Response\SummaryPayRoll\PayRollResponse;
use IOET\Acme\PayRoll\Employee\Application\SearchAllWorkedHoursEmployees\AllWorkedHoursEmployeesSearcher;
use IOET\Acme\PayRoll\Employee\Domain\EmployeeWorkedHoursRepository;
use IOET\Acme\PayRoll\Employee\Infrastructure\RateWorkedHoursRepository;

final class AllWorkedHoursEmployeesCalculator
{

    private AllWorkedHoursEmployeesSearcher $workedHoursEmployeesSearcher;
    private AllEmployeesNameFilter $employeesNameFilter;
    private RateByWorkedHoursReportedGetter $getterRate;
    public array $rateByDaysOfWeek;

    public function __construct(
        EmployeeWorkedHoursRepository $employeeWorkedHoursRepository,
        RateWorkedHoursRepository $rateWorkedHoursRepository
    )
    {
        $this->workedHoursEmployeesSearcher = new AllWorkedHoursEmployeesSearcher($employeeWorkedHoursRepository);
        $this->employeesNameFilter = new AllEmployeesNameFilter($employeeWorkedHoursRepository);
        $this->getterRate = new RateByWorkedHoursReportedGetter($rateWorkedHoursRepository);
        $this->initializeRateByDaysOfWeek();
    }

    public function calculate(string $filename): PayRollListResponse
    {
        $listToPay = array();
        $employeesList = $this->employeesNameFilter->filter($filename);
        $workedHoursReported = $this->workedHoursEmployeesSearcher->searchAll($filename);
        foreach($employeesList->names() as $employee)
        {
            $workedHoursReportedByEmployee =
            array_filter($workedHoursReported->workedHours(), function(AllWorkedHoursEmployeeResponse $item) use($employee) {
                return $item->employeeName() == $employee->name();
            }, ARRAY_FILTER_USE_BOTH );

            $totalToPayByEmployee = 0;
            foreach ($workedHoursReportedByEmployee as $key => $value) {
                //print("\n");
                //print($key);
                //print($value->employeeName()." -- ".$value->day()." -- ".$value->hourFrom()." -- ".$value->hourTo());
                $totalToPayByEmployee +=
                $this->calculateByDay($this->getterRate->__invoke(
                                        $value->day(), 
                                        $value->hourFrom(), 
                                        $value->hourTo())
                );
            }
            $listToPay[] = new PayRollResponse($employee->name(), $totalToPayByEmployee);
            //print("------------------");
            //print($workedHoursReportedByEmployee[0]->employeeName());

        }

        return new PayRollListResponse(...$listToPay);
        
    }

    private function initializeRateByDaysOfWeek()
    {
        /*$this->rateByDaysOfWeek  = [
            "dayOfWeek" => [],
            "weekend" => []
        ];*/
        $this->rateByDaysOfWeek  = [];
        $this->generateRange(0, 1, 1, 9);
        $this->generateRange(0, 2, 1, 9);
        $this->generateRange(0, 3, 1, 9);

        $this->generateRange(1, 1, 1, 9);
        $this->generateRange(1, 2, 1, 9);
        $this->generateRange(1, 3, 1, 9);
        
    }

    private function generateRange(int $type, int $journal, int $from, int $to)
    {
        $range = array();
        for($i=$from; $i <= $to; $i++ )
        {
            $range[$i] = -1;
        }
        $this->rateByDaysOfWeek[$type][$journal] = $range;
    }

    private function calculateByDay(array $workedHoursReportedByDay)
    {
        //print_r($workedHoursReportedByDay);
        
        if (array_key_exists("typeOfDay", $workedHoursReportedByDay) &&
            array_key_exists("journal", $workedHoursReportedByDay) && 
            array_key_exists("workedHours", $workedHoursReportedByDay))
        {
            $type = $workedHoursReportedByDay["typeOfDay"];
            $journal = $workedHoursReportedByDay["journal"];
            $hour = $workedHoursReportedByDay["workedHours"];
        }
        else {
            return 0;
        }
        
        if ($this->rateByDaysOfWeek[$type][$journal][$hour] == -1)
        {
            $this->rateByDaysOfWeek[$type][$journal][$hour] = $workedHoursReportedByDay['workedHours'] * $workedHoursReportedByDay['rate'];
        }
        return $this->rateByDaysOfWeek[$type][$journal][$hour];
    }
}