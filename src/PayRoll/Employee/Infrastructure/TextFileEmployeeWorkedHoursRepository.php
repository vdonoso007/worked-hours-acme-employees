<?php

declare(strict_types=1);

namespace IOET\Acme\PayRoll\Employee\Infrastructure;

use IOET\Acme\PayRoll\Employee\Domain\EmployeeWorkedHoursRepository;
use IOET\Acme\Shared\Infrastructure\TextFile\TextFileRepository;
use IOET\Acme\PayRoll\Employee\Domain\Entity\EmployeeWorkedHours;
use IOET\Acme\PayRoll\Employee\Domain\ValueObject\EmployeeName;
use IOET\Acme\PayRoll\Employee\Domain\ValueObject\EmployeeTimeRange;

final class TextFileEmployeeWorkedHoursRepository extends TextFileRepository implements EmployeeWorkedHoursRepository
{

    public function findAll(string $filename): array
    {
        $data = $this->read($filename);
        $result = [];
        foreach($data as $line)
        {
            $lineByEmployee = explode(",", $line);
            $name = "";
            foreach($lineByEmployee as $key => $reportedDays)
            {
                $range = "";
                $from = "";
                $to = "";
                $day = "";
                if ($key == 0)
                {
                    $range = explode("-", $reportedDays);
                    $from = substr( explode("=", $range[0])[1], 2 );
                    $to = $range[1];
                    $day = substr( explode("=", $range[0])[1], 0, 2 );
                    $name = explode("=", $range[0])[0];
                }
                else {
                    $range = explode("-", $reportedDays);
                    $from = substr( $range[0], 2 );
                    $to = $range[1];
                    $day = substr( $range[0], 0, 2 );
                }
                $result[] = new EmployeeWorkedHours(
                    new EmployeeName($name),
                    new EmployeeTimeRange($day, $from, $to)
                );
            }
        }
        
        return $result;
    }
}