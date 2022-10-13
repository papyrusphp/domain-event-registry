<?php

declare(strict_types=1);

namespace Papyrus\DomainEventRegistry\Test\DomainEventNameResolver\ClassBased;

use Doctrine\Inflector\InflectorFactory;
use Papyrus\DomainEventRegistry\DomainEventNameResolver\ClassBased\ClassBasedDomainEventNameResolver;
use Papyrus\DomainEventRegistry\DomainEventNameResolver\ClassBased\ClassBasedDomainEventNameResolverDecorator;
use Papyrus\DomainEventRegistry\DomainEventNameResolver\NamedDomainEvent\NamedDomainEventNameResolver;
use Papyrus\DomainEventRegistry\Test\DomainEventNameResolver\NamedDomainEvent\Stub\TestNotNamedDomainEvent;
use Papyrus\DomainEventRegistry\Test\InMemory\Stub\TestDomainEvent;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
class ClassBasedDomainEventNameResolverDecoratorTest extends TestCase
{
    private ClassBasedDomainEventNameResolverDecorator $decorator;

    protected function setUp(): void
    {
        $this->decorator = new ClassBasedDomainEventNameResolverDecorator(
            new ClassBasedDomainEventNameResolver(InflectorFactory::create()->build()),
            new NamedDomainEventNameResolver(),
        );

        parent::setUp();
    }

    /**
     * @test
     */
    public function itShouldResolveDomainEventNameByNamedDomainEventResolver(): void
    {
        $eventName = $this->decorator->resolve(new TestDomainEvent());

        self::assertSame('test.domain-event', $eventName);
    }

    /**
     * @test
     */
    public function itShouldResolveDomainEventNameByClassBasedResolver(): void
    {
        $eventName = $this->decorator->resolve(new TestNotNamedDomainEvent());

        self::assertSame(
            'papyrus.domain-event-registry.test.domain-event-name-resolver.named-domain-event.stub.test-not-named-domain-event',
            $eventName,
        );
    }
}
