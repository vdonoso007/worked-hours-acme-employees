<?php

declare(strict_types=1);

namespace IOET\Acme\PayRoll\Employee\Application\Response;

use IOET\Acme\Shared\Domain\Bus\Query\Response;

final class AllWorkedHoursEmployeeResponse implements Response
{

    private string $employeeName;
    private string $day;
    private string $hourFrom;
    private string $hourTo;

    public function __construct(
        string $employeeName,
        string $day,
        string $hourFrom,
        string $hourTo)
    {
        $this->employeeName = $employeeName;
        $this->day = $day;
        $this->hourFrom = $hourFrom;
        $this->hourTo = $hourTo;
    }

    public function employeeName(): string
    {
        return $this->employeeName;
    }

    public function day(): string
    {
        return $this->day;
    }

    public function hourFrom(): string
    {
        return $this->hourFrom;
    }

    public function hourTo(): string
    {
        return $this->hourTo;
    }
}