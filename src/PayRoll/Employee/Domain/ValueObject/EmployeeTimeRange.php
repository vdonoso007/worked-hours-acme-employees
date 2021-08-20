<?php

declare(strict_types=1);

namespace IOET\Acme\PayRoll\Employee\Domain\ValueObject;

class EmployeeTimeRange
{

    
    private string $from;
    private string $to;
    private string $dayOfWeek;

    public function __construct(string $dayOfWeek, string $from, string $to)
    {
        $this->dayOfWeek = $dayOfWeek;
        $this->from = $from;
        $this->to = $to;
    }

    public function from(): string
    {
        return $this->from;
    }

    public function to(): string
    {
        return $this->to;
    }

    public function dayOfWeek(): string
    {
        return $this->dayOfWeek;
    }
}