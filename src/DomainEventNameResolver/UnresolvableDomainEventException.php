<?php

declare(strict_types=1);

namespace Papyrus\DomainEventRegistry\DomainEventNameResolver;

use Exception;
use Papyrus\EventSourcing\DomainEvent;

final class UnresolvableDomainEventException extends Exception
{
    public static function withEvent(string|DomainEvent $event): self
    {
        return new self(sprintf(
            'Unable to resolve name from event `%s`',
            $event instanceof DomainEvent ? $event::class : $event,
        ));
    }
}
