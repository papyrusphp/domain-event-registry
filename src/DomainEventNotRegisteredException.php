<?php

declare(strict_types=1);

namespace Papyrus\DomainEventRegistry;

use Exception;

final class DomainEventNotRegisteredException extends Exception
{
    public static function withEventName(string $eventName): self
    {
        return new self(sprintf('Event `%s` not registered', $eventName));
    }
}
