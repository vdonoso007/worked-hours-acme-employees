<?php

namespace IOET\Acme\Tests\PayRoll\Employee;

use IOET\Acme\PayRoll\Employee\Domain\EmployeeWorkedHoursRepository;
use IOET\Acme\PayRoll\Employee\Domain\RatePerHourRepository;
use Mockery\MockInterface;
use IOET\Acme\Tests\Shared\Infrastructure\PhpUnit\UnitTestCase;

abstract class PayRollModuleUnitTest extends UnitTestCase
{

    private $employeeWorkedHoursRepository;
    private $ratePerHourRepository;

    protected function shouldFindAllEmployeeWorkedHours(string $filename, array $workedHours)
    {
        $this->employeeWorkedHoursRepository()
             ->shouldReceive('findAll')
             ->with($filename)
             ->once()
             ->andReturn($workedHours);
    }

    protected function shouldGetRatePerHour(array $ratesPerHour)
    {
        $this->ratePerHourRepository()
             ->shouldReceive('get')
             ->once()
             ->andReturn($ratesPerHour);
    }

    protected function employeeWorkedHoursRepository(): MockInterface
    {
        return $this->employeeWorkedHoursRepository = $this->employeeWorkedHoursRepository ?: $this->mock(EmployeeWorkedHoursRepository::class);
    }

    protected function ratePerHourRepository(): MockInterface
    {
        return $this->ratePerHourRepository = $this->ratePerHourRepository ?: $this->mock(RatePerHourRepository::class);
    }
}