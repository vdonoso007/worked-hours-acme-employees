<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'IOET\Acme\Shared\Infrastructure\Bus\Query\InMemorySymfonyQueryBus' shared autowired service.

return $this->privates['IOET\\Acme\\Shared\\Infrastructure\\Bus\\Query\\InMemorySymfonyQueryBus'] = new \IOET\Acme\Shared\Infrastructure\Bus\Query\InMemorySymfonyQueryBus(new RewindableGenerator(function () {
    yield 0 => ($this->privates['IOET\\Acme\\PayRoll\\Employee\\Application\\CalculateAllWorkedHoursEmployees\\CalculateAllWorkedHoursEmployeesQueryHandler'] ?? $this->load('getCalculateAllWorkedHoursEmployeesQueryHandlerService.php'));
    yield 1 => ($this->privates['IOET\\Acme\\PayRoll\\Employee\\Application\\GetAllEmployeesName\\GetAllEmployeesNameQueryHandler'] ?? $this->load('getGetAllEmployeesNameQueryHandlerService.php'));
    yield 2 => ($this->privates['IOET\\Acme\\PayRoll\\Employee\\Application\\SearchAllWorkedHoursEmployees\\SearchAllWorkedHoursEmployeesQueryHandler'] ?? $this->load('getSearchAllWorkedHoursEmployeesQueryHandlerService.php'));
}, 3));
