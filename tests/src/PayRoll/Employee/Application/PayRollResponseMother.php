<?php

namespace IOET\Acme\Tests\PayRoll\Employee\Application;

use IOET\Acme\PayRoll\Employee\Application\Response\SummaryPayRoll\PayRollResponse;

class PayRollResponseMother
{

    public static function fromWorkedHoursCalculated(array $workedHoursCalculated): array
    {
        $responses = [];

        foreach ($workedHoursCalculated as $item) {
            $responses[] = new PayRollResponse(
                $item['employeeName'],
                $item['totalToPay']
            );
        }
        return $responses;
    }
}