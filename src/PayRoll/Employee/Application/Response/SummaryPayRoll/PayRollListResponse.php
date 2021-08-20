<?php

declare(strict_types = 1);

namespace IOET\Acme\PayRoll\Employee\Application\Response\SummaryPayRoll;

use IOET\Acme\Shared\Domain\Bus\Query\Response;

final class PayRollListResponse implements Response
{

    private array $listToPay;

    public function __construct(PayRollResponse ...$listToPay)
    {
        $this->listToPay = $listToPay;
    }

    public function listToPay(): array
    {
        return $this->listToPay;
    }
}