<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'IOET\Apps\Acme\PayRoll\v1\Employee\Command\ListingPayRollEmployeesCommand' shared autowired service.

include_once \dirname(__DIR__, 4).'/src/Command/ListingPayRollEmployeesCommand.php';

$this->privates['IOET\\Apps\\Acme\\PayRoll\\v1\\Employee\\Command\\ListingPayRollEmployeesCommand'] = $instance = new \IOET\Apps\Acme\PayRoll\v1\Employee\Command\ListingPayRollEmployeesCommand(($this->privates['IOET\\Acme\\Shared\\Infrastructure\\Bus\\Query\\InMemorySymfonyQueryBus'] ?? $this->load('getInMemorySymfonyQueryBusService.php')));

$instance->setName('ioet:payroll');

return $instance;
