<?php

declare(strict_types=1);

namespace Papyrus\DomainEventRegistry\DomainEventNameResolver\ClassBased;

use Papyrus\DomainEventRegistry\DomainEventNameResolver\DomainEventNameResolver;
use Papyrus\DomainEventRegistry\DomainEventNameResolver\UnresolvableDomainEventException;

/**
 * @template DomainEvent of object
 *
 * @implements DomainEventNameResolver<DomainEvent>
 */
final class ClassBasedDomainEventNameResolverDecorator implements DomainEventNameResolver
{
    /**
     * @param ClassBasedDomainEventNameResolver<DomainEvent> $classBasedDomainEventNameResolver
     * @param DomainEventNameResolver<DomainEvent> $domainEventNameResolver
     */
    public function __construct(
        private readonly ClassBasedDomainEventNameResolver $classBasedDomainEventNameResolver,
        private readonly DomainEventNameResolver $domainEventNameResolver,
    ) {
    }

    public function resolve(string|object $event): string
    {
        try {
            return $this->domainEventNameResolver->resolve($event);
        } catch (UnresolvableDomainEventException) {
            return $this->classBasedDomainEventNameResolver->resolve($event);
        }
    }
}
