<?php

declare(strict_types=1);

namespace Papyrus\DomainEventRegistry\Test\DomainEventNameResolver\ClassBased;

use Doctrine\Inflector\InflectorFactory;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use Mockery\MockInterface;
use Papyrus\DomainEventRegistry\DomainEventNameResolver\ClassBased\ClassBasedDomainEventNameResolver;
use Papyrus\DomainEventRegistry\DomainEventNameResolver\ClassBased\ClassBasedDomainEventNameResolverDecorator;
use Papyrus\DomainEventRegistry\DomainEventNameResolver\DomainEventNameResolver;
use Papyrus\DomainEventRegistry\DomainEventNameResolver\UnresolvableDomainEventException;
use Papyrus\DomainEventRegistry\Test\InMemory\Stub\TestDomainEvent;
use stdClass;

/**
 * @internal
 */
class ClassBasedDomainEventNameResolverDecoratorTest extends MockeryTestCase
{
    /**
     * @var ClassBasedDomainEventNameResolverDecorator<object>
     */
    private ClassBasedDomainEventNameResolverDecorator $decorator;

    /**
     * @var MockInterface&DomainEventNameResolver<object>
     */
    private MockInterface $resolver;

    protected function setUp(): void
    {
        $this->decorator = new ClassBasedDomainEventNameResolverDecorator(
            new ClassBasedDomainEventNameResolver(InflectorFactory::create()->build()),
            $this->resolver = Mockery::mock(DomainEventNameResolver::class),
        );

        parent::setUp();
    }

    /**
     * @test
     */
    public function itShouldResolveDomainEventNameByDecoratedDomainEventResolver(): void
    {
        $this->resolver->expects('resolve')->andReturn('test.domain-event');

        $eventName = $this->decorator->resolve(new stdClass());

        self::assertSame('test.domain-event', $eventName);
    }

    /**
     * @test
     */
    public function itShouldResolveDomainEventNameByClassBasedResolver(): void
    {
        $this->resolver->expects('resolve')
            ->andThrow(UnresolvableDomainEventException::withEvent(new TestDomainEvent()))
        ;

        $eventName = $this->decorator->resolve(new TestDomainEvent());

        self::assertSame(
            'papyrus.domain-event-registry.test.in-memory.stub.test-domain-event',
            $eventName,
        );
    }
}
