<?php

declare(strict_types=1);

namespace Papyrus\DomainEventRegistry\Test\InMemory;

use Doctrine\Inflector\InflectorFactory;
use Papyrus\DomainEventRegistry\DomainEventNameResolver\ClassBased\ClassBasedDomainEventNameResolver;
use Papyrus\DomainEventRegistry\DomainEventNotRegisteredException;
use Papyrus\DomainEventRegistry\InMemory\InMemoryDomainEventRegistry;
use Papyrus\DomainEventRegistry\Test\InMemory\Stub\TestDomainEvent;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
class InMemoryDomainEventRegistryTest extends TestCase
{
    /** @var InMemoryDomainEventRegistry<TestDomainEvent> */
    private InMemoryDomainEventRegistry $registry;

    protected function setUp(): void
    {
        /** @var ClassBasedDomainEventNameResolver<TestDomainEvent> $domainEventResolver */
        $domainEventResolver = new ClassBasedDomainEventNameResolver(InflectorFactory::create()->build());

        $this->registry = new InMemoryDomainEventRegistry(
            $domainEventResolver,
            [
                TestDomainEvent::class,
            ],
        );

        parent::setUp();
    }

    /**
     * @test
     */
    public function itShouldRetrieveRegisteredDomainEvent(): void
    {
        self::assertSame(
            TestDomainEvent::class,
            $this->registry->retrieve('papyrus.domain-event-registry.test.in-memory.stub.test-domain-event'),
        );
    }

    /**
     * @test
     */
    public function itShouldThrowExceptionWhenDomainEventIsNotRegistered(): void
    {
        self::expectException(DomainEventNotRegisteredException::class);

        $this->registry->retrieve('unknown.test.domain-event');
    }
}
