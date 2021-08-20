<?php

declare(strict_types=1);

namespace IOET\Acme\Tests\PayRoll\Employee\Infrastructure;

use IOET\Acme\PayRoll\Employee\Application\CalculateAllWorkedHoursEmployees\AllWorkedHoursEmployeesCalculator;
use IOET\Acme\PayRoll\Employee\Domain\FileNotFoundException;
use IOET\Acme\PayRoll\Employee\Infrastructure\RateWorkedHoursRepository;
use IOET\Acme\PayRoll\Employee\Infrastructure\TextFileEmployeeWorkedHoursRepository;
use PHPUnit\Framework\TestCase;

class TextFileTest extends TestCase
{

    protected function setUp(): void
    {
        
    }
    /** @test */
    public function it_should_test_load_file()
    {
        $readingFile = new TextFileObjectMother();
        $data = $readingFile->loadFile("Worked_Hours_ACME_EMPLOYESS.txt");
        //print_r($data);
        $this->assertEquals(34,count($data));
    }

    /** @test */
    public function it_should_test_query_get_all_employees_use_case()
    {
        $readingFile = new TextFileObjectMother();
        $data = $readingFile->getAllEmployees("Worked_Hours_ACME_EMPLOYESS.txt");
        //print_r($data);
        $this->assertEquals(count($data),count($data));
    }

    /** @test */
    public function gaven_some_one_employee_it_should_test_get_rate_by_worked_hours_reported_use_case()
    {
        $readingFile = new TextFileObjectMother();
        $data = $readingFile->getRateByWorkedHoursReportedPerEmployee("MO", "10:00", "12:00");
        $this->assertEquals(15, $data['rate']);
        $this->assertEquals(2, $data['workedHours']);
    }

    /** @test */
    public function test_rate()
    {
        $calculate = new AllWorkedHoursEmployeesCalculator( 
            new TextFileEmployeeWorkedHoursRepository,
            new RateWorkedHoursRepository
        );
        /*foreach($calculate->rateByDaysOfWeek['dayOfWeek']['journal1'] as $index => $item)
        {
            //$item['dayOfWeek']
            print("\n");
            print($index."---* ".$item);
        }*/
        //print_r($calculate->calculate());
        $this->assertEquals(1, 1);
    }

    /** @test */
    /*public function it_should_throw_not_found_exception()
    {
        $this->expectException(FileNotFoundException::class);
    }*/
}