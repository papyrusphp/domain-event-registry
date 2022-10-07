<?php

declare(strict_types=1);

namespace Papyrus\DomainEventRegistry;

use Papyrus\EventSourcing\DomainEvent;

interface DomainEventRegistry
{
    /**
     * @throws DomainEventNotRegisteredException
     *
     * @return class-string<DomainEvent>
     */
    public function retrieve(string $eventName): string;
}
