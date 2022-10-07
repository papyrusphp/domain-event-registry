<?php

declare(strict_types=1);

namespace Papyrus\DomainEventRegistry\Test\InMemory;

use Papyrus\DomainEventRegistry\DomainEventNotRegisteredException;
use Papyrus\DomainEventRegistry\InMemory\InMemoryDomainEventRegistry;
use Papyrus\DomainEventRegistry\Test\InMemory\Stub\TestDomainEvent;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
class InMemoryDomainEventRegistryTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldRetrieveRegisteredDomainEvent(): void
    {
        $registry = new InMemoryDomainEventRegistry([
            TestDomainEvent::class,
        ]);

        self::assertSame(TestDomainEvent::class, $registry->retrieve('test.domain-event'));
    }

    /**
     * @test
     */
    public function itShouldThrowExceptionWhenDomainEventIsNotRegistered(): void
    {
        $registry = new InMemoryDomainEventRegistry([
            TestDomainEvent::class,
        ]);

        self::expectException(DomainEventNotRegisteredException::class);

        $registry->retrieve('unknown.test.domain-event');
    }
}
