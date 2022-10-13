<?php

declare(strict_types=1);

namespace Papyrus\DomainEventRegistry\InMemory;

use Papyrus\DomainEventRegistry\DomainEventNameResolver\DomainEventNameResolver;
use Papyrus\DomainEventRegistry\DomainEventNotRegisteredException;
use Papyrus\DomainEventRegistry\DomainEventRegistry;
use Papyrus\EventSourcing\DomainEvent;

final class InMemoryDomainEventRegistry implements DomainEventRegistry
{
    /**
     * @var array<string, class-string<DomainEvent>>
     */
    private array $registeredEvents = [];

    /**
     * @param list<class-string<DomainEvent>> $eventClassNames
     */
    public function __construct(
        private readonly DomainEventNameResolver $domainEventNameResolver,
        array $eventClassNames,
    ) {
        foreach ($eventClassNames as $eventClassName) {
            if (is_subclass_of($eventClassName, DomainEvent::class)) {
                $this->registeredEvents[$this->domainEventNameResolver->resolve($eventClassName)] = $eventClassName;
            }
        }
    }

    public function retrieve(string $eventName): string
    {
        if (array_key_exists($eventName, $this->registeredEvents) === false) {
            throw DomainEventNotRegisteredException::withEventName($eventName);
        }

        return $this->registeredEvents[$eventName];
    }
}
