<?php

declare(strict_types=1);

namespace Papyrus\DomainEventRegistry\DomainEventNameResolver\NamedDomainEvent;

use Papyrus\DomainEventRegistry\DomainEventNameResolver\DomainEventNameResolver;
use Papyrus\DomainEventRegistry\DomainEventNameResolver\NamedDomainEvent;
use Papyrus\DomainEventRegistry\DomainEventNameResolver\UnresolvableDomainEventException;
use Papyrus\EventSourcing\DomainEvent;

final class NamedDomainEventNameResolver implements DomainEventNameResolver
{
    public function resolve(string|DomainEvent $event): string
    {
        if ($event instanceof NamedDomainEvent === false
            && is_subclass_of($event, NamedDomainEvent::class) === false
        ) {
            throw UnresolvableDomainEventException::withEvent($event);
        }

        return $event::getEventName();
    }
}
