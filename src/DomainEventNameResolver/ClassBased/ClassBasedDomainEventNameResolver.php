<?php

declare(strict_types=1);

namespace Papyrus\DomainEventRegistry\DomainEventNameResolver\ClassBased;

use Doctrine\Inflector\Inflector;
use Papyrus\DomainEventRegistry\DomainEventNameResolver\DomainEventNameResolver;
use Papyrus\EventSourcing\DomainEvent;

final class ClassBasedDomainEventNameResolver implements DomainEventNameResolver
{
    public function __construct(
        private readonly Inflector $inflector,
    ) {
    }

    public function resolve(string|DomainEvent $event): string
    {
        if ($event instanceof DomainEvent) {
            $event = $event::class;
        }

        return str_replace(['\\', '_'], ['.', '-'], $this->inflector->tableize($event));
    }
}
