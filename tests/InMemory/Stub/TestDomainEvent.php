<?php

declare(strict_types=1);

namespace Papyrus\DomainEventRegistry\Test\InMemory\Stub;

use Papyrus\DomainEventRegistry\DomainEventNameResolver\NamedDomainEvent;
use Papyrus\EventSourcing\DomainEvent;

final class TestDomainEvent implements DomainEvent, NamedDomainEvent
{
    public static function getEventName(): string
    {
        return 'test.domain-event';
    }

    public function getAggregateRootId(): string
    {
        return '';
    }
}
