<?php

declare(strict_types=1);

namespace IOET\Apps\Acme\PayRoll\v1\Employee\Command;

use IOET\Acme\PayRoll\Employee\Application\CalculateAllWorkedHoursEmployees\CalculateAllWorkedHoursEmployeesQuery as Query;
use IOET\Acme\PayRoll\Employee\Application\Response\SummaryPayRoll\PayRollListResponse;
use IOET\Acme\PayRoll\Employee\Application\Response\SummaryPayRoll\PayRollResponse;
use Symfony\Component\Console\Command\Command as ConsoleCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use IOET\Acme\Shared\Domain\Bus\Query\QueryBus;
use IOET\Acme\Shared\Domain\Bus\Query\Response;
use Symfony\Component\Console\Helper\Table;

use function Lambdish\Phunctional\map;

final class ListingPayRollEmployeesCommand extends ConsoleCommand
{

    private QueryBus $queryBus;
    private PayRollListResponse $response;

    protected static $defaultName = 'ioet:payroll';

    public function __construct(QueryBus $queryBus)
    {
        $this->queryBus = $queryBus;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setDescription("Display a PayRoll list Acme's employees")
            ->addArgument('filename', InputArgument::REQUIRED, 'Name of file')
            ->setHelp("This command allows you to show a PayRoll list of Acme's employees");
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

        $data = map($this->toArray(),  $this->response->listToPay());

        $table = new Table($output);
        $table
            ->setHeaders(['Employee', 'Total'])
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
        return static function (PayRollResponse $response) {
            return [
                'Employee' => $response->employeeName(),
                'TotalToPay' => $response->totalToPay()
            ];
        };
    }

}