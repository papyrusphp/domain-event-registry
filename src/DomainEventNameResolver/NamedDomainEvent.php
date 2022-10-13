<?php

declare(strict_types=1);

namespace Papyrus\DomainEventRegistry\DomainEventNameResolver;

interface NamedDomainEvent
{
    public static function getEventName(): string;
}
