<?php

namespace IOET\Acme\Tests\PayRoll\Employee\Application;

use IOET\Acme\PayRoll\Employee\Application\CalculateAllWorkedHoursEmployees\AllWorkedHoursEmployeesCalculator;
use IOET\Acme\PayRoll\Employee\Application\CalculateAllWorkedHoursEmployees\CalculateAllWorkedHoursEmployeesQueryHandler;
use IOET\Acme\Tests\PayRoll\Employee\PayRollModuleUnitTest;
use IOET\Acme\Tests\PayRoll\Employee\Domain\EmployeeWorkedHoursMother;

class CalculateAllWorkedHoursEmployeesQueryHandlerTest extends PayRollModuleUnitTest
{

    private $handler;

    protected function setUp(): void
    {
        $this->handler = new CalculateAllWorkedHoursEmployeesQueryHandler(
            new AllWorkedHoursEmployeesCalculator(
                $this->employeeWorkedHoursRepository(),
                $this->ratePerHourRepository()
            )
        );
        parent::setUp();
    }

    /** @test */
    public function it_should_get_employee_payroll_list_when_filename_is_provided(): void
    {
        $query = CalculateAllWorkedHoursEmployeesQueryMother::withFilename();

        $payRollResponses = PayRollResponseMother::fromWorkedHoursCalculated([]);
        $payRollListResponse = PayRollListResponseMother::fromPayRollResponses($payRollResponses[0]);

        $workedHours = EmployeeWorkedHoursMother::randomSerializedArray();
        $this->shouldFindAllEmployeeWorkedHours($query->filename(), $workedHours);

        $this->assertAskResponse($payRollListResponse, $query, $this->handler);
        
    }
}