<?php

declare(strict_types=1);

namespace IOET\Acme\PayRoll\Employee\Application\Response\SummaryPayRoll;

use IOET\Acme\Shared\Domain\Bus\Query\Response;

final class PayRollResponse implements Response
{

    private string $employeeName;
    private float $totalToPay;

    public function __construct(string $employeeName, float $totalToPay)
    {
        $this->employeeName = $employeeName;
        $this->totalToPay = $totalToPay;
    }

    public function employeeName(): string
    {
        return $this->employeeName;
    }

    public function totalToPay(): float
    {
        return $this->totalToPay;
    }
}