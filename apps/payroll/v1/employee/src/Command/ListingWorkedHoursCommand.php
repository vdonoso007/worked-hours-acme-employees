<?php

declare(strict_types=1);

namespace IOET\Apps\Acme\PayRoll\v1\Employee\Command;

use IOET\Acme\PayRoll\Employee\Application\Response\AllWorkedHoursEmployeeResponse;
use IOET\Acme\PayRoll\Employee\Application\Response\AllWorkedHoursEmployeesResponse;
use IOET\Acme\PayRoll\Employee\Application\SearchAllWorkedHoursEmployees\SearchAllWorkedHoursEmployeesQuery as Query;
use Symfony\Component\Console\Command\Command as ConsoleCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use IOET\Acme\Shared\Domain\Bus\Query\QueryBus;
use IOET\Acme\Shared\Domain\Bus\Query\Response;
use Symfony\Component\Console\Helper\Table;

use function Lambdish\Phunctional\map;

final class ListingWorkedHoursCommand extends ConsoleCommand
{

    private QueryBus $queryBus;
    private AllWorkedHoursEmployeesResponse $response;

    protected static $defaultName = 'ioet:list-worked-hours-employees';

    public function __construct(QueryBus $queryBus)
    {
        $this->queryBus = $queryBus;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setDescription("Display a list worked hours of Acme's employees")
            ->addArgument('filename', InputArgument::REQUIRED, 'Name of file')
            ->setHelp("This command allows you to show a list worked hours of Acme's employees");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'Acme PayRoll',
            '============',
            '',
        ]);

        $filename = $input->getArgument('filename');

        $query = new Query($filename);

        $this->response = $this->ask($query);

        $data = map($this->toArray(),  $this->response->workedHours());

        $table = new Table($output);
        $table
            ->setHeaders(['Employee', 'Day', 'From', 'To'])
            ->setRows($data);
        $table->render();

        return 0;
       
    }

    private function ask(Query $query): ?Response 
    {
        return $this->queryBus->ask($query);
    }

    private function toArray(): callable
    {
        return static function (AllWorkedHoursEmployeeResponse $response) {
            return [
                'Employee' => $response->employeeName(),
                'Day' => $response->day(),
                'From' => $response->hourFrom(),
                'To' => $response->hourTo()
            ];
        };
    }

}