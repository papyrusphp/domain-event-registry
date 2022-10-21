<?php

declare(strict_types=1);

namespace Papyrus\DomainEventRegistry\DomainEventNameResolver;

/**
 * @template DomainEvent of object
 */
interface DomainEventNameResolver
{
    /**
     * @param class-string<DomainEvent>|DomainEvent $event
     *
     * @throws UnresolvableDomainEventException
     */
    public function resolve(string|object $event): string;
}
