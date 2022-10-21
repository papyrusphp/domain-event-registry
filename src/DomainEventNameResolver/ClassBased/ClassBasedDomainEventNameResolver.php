<?php

declare(strict_types=1);

namespace Papyrus\DomainEventRegistry\DomainEventNameResolver\ClassBased;

use Doctrine\Inflector\Inflector;
use Papyrus\DomainEventRegistry\DomainEventNameResolver\DomainEventNameResolver;

/**
 * @template DomainEvent of object
 *
 * @implements DomainEventNameResolver<DomainEvent>
 */
final class ClassBasedDomainEventNameResolver implements DomainEventNameResolver
{
    public function __construct(
        private readonly Inflector $inflector,
    ) {
    }

    public function resolve(string|object $event): string
    {
        if (is_object($event)) {
            $event = $event::class;
        }

        return str_replace(['\\', '_'], ['.', '-'], $this->inflector->tableize($event));
    }
}
