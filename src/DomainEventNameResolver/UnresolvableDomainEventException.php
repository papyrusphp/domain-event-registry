<?php

declare(strict_types=1);

namespace Papyrus\DomainEventRegistry\DomainEventNameResolver;

use Exception;

final class UnresolvableDomainEventException extends Exception
{
    public static function withEvent(string|object $event): self
    {
        return new self(sprintf(
            'Unable to resolve name from event `%s`',
            is_object($event) ? $event::class : $event,
        ));
    }
}
