<?php

declare(strict_types=1);

namespace IOET\Acme\Tests\Shared\Infrastructure\PhpUnit;

use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use Mockery\Matcher\MatcherAbstract;
use Mockery\MockInterface;
use VEEngine\Shared\Domain\Bus\Event\DomainEvent;
use IOET\Acme\Shared\Domain\Bus\Event\EventBus;
use IOET\Acme\Shared\Domain\Bus\Query\Query;
use IOET\Acme\Shared\Domain\Bus\Query\Response;
use VEEngine\Tests\Shared\Domain\TestUtils;

abstract class UnitTestCase extends MockeryTestCase
{
    private $eventBus;

    protected function mock(string $className): MockInterface
    {
        return Mockery::mock($className);
    }

    /** @return EventBus|MockInterface */
    protected function eventBus(): MockInterface
    {
        return $this->eventBus = $this->eventBus ?: $this->mock(EventBus::class);
    }

    protected function assertAskResponse(Response $expected, Query $query, callable $queryHandler): void
    {
        $actual = $queryHandler($query);

        $this->assertEquals($expected, $actual);
    }

    protected function assertAskThrowsException(string $expectedErrorClass, Query $query, callable $queryHandler): void
    {
        $this->expectException($expectedErrorClass);

        $queryHandler($query);
    }

}