<?php

declare(strict_types=1);

namespace Papyrus\DomainEventRegistry\Test\DomainEventNameResolver\ClassBased;

use Doctrine\Inflector\InflectorFactory;
use Papyrus\DomainEventRegistry\DomainEventNameResolver\ClassBased\ClassBasedDomainEventNameResolver;
use Papyrus\DomainEventRegistry\Test\InMemory\Stub\TestDomainEvent;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
class ClassBasedDomainEventNameResolverTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldResolveName(): void
    {
        $resolver = new ClassBasedDomainEventNameResolver(InflectorFactory::create()->build());

        self::assertSame(
            'papyrus.domain-event-registry.test.in-memory.stub.test-domain-event',
            $resolver->resolve(TestDomainEvent::class),
        );
    }
}
