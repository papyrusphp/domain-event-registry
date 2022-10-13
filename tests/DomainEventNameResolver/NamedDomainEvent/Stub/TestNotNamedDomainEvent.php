<?php

declare(strict_types=1);

namespace Papyrus\DomainEventRegistry\Test\DomainEventNameResolver\NamedDomainEvent\Stub;

use Papyrus\EventSourcing\DomainEvent;

final class TestNotNamedDomainEvent implements DomainEvent
{
    public function getAggregateRootId(): string
    {
        return '5a92e7c7-ef65-419f-b973-bb4f693239d1';
    }
}
