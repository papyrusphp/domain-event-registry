<?php

declare(strict_types=1);

namespace Papyrus\DomainEventRegistry\DomainEventNameResolver;

use Papyrus\EventSourcing\DomainEvent;

interface DomainEventNameResolver
{
    /**
     * @param class-string<DomainEvent>|DomainEvent $event
     *
     * @throws UnresolvableDomainEventException
     */
    public function resolve(string|DomainEvent $event): string;
}
