<?php

declare(strict_types=1);

namespace Papyrus\DomainEventRegistry\Test\DomainEventNameResolver\NamedDomainEvent;

use Papyrus\DomainEventRegistry\DomainEventNameResolver\NamedDomainEvent\NamedDomainEventNameResolver;
use Papyrus\DomainEventRegistry\DomainEventNameResolver\UnresolvableDomainEventException;
use Papyrus\DomainEventRegistry\Test\DomainEventNameResolver\NamedDomainEvent\Stub\TestNotNamedDomainEvent;
use Papyrus\DomainEventRegistry\Test\InMemory\Stub\TestDomainEvent;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
class NamedDomainEventNameResolverTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldResolveNameFromEvent(): void
    {
        $resolver = new NamedDomainEventNameResolver();

        self::assertSame('test.domain-event', $resolver->resolve(new TestDomainEvent()));
    }

    /**
     * @test
     */
    public function itShouldResolveNameFromEventFqcn(): void
    {
        $resolver = new NamedDomainEventNameResolver();

        self::assertSame('test.domain-event', $resolver->resolve(TestDomainEvent::class));
    }

    /**
     * @test
     */
    public function itShouldThrowExceptionIfEventIsNotNamedDomainEvent(): void
    {
        $resolver = new NamedDomainEventNameResolver();

        self::expectException(UnresolvableDomainEventException::class);

        $resolver->resolve(TestNotNamedDomainEvent::class);
    }
}
