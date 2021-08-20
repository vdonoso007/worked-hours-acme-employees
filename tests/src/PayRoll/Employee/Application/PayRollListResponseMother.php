<?php

namespace IOET\Acme\Tests\PayRoll\Employee\Application;

use IOET\Acme\PayRoll\Employee\Application\Response\SummaryPayRoll\PayRollListResponse;
use IOET\Acme\PayRoll\Employee\Application\Response\SummaryPayRoll\PayRollResponse;

class PayRollListResponseMother
{
    
    public static function fromPayRollResponses(PayRollResponse ...$payRollResponse): PayRollListResponse
    {
        return new PayRollListResponse($payRollResponse[0]);
    }
}