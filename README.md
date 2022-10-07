# 📜 Papyrus Domain event registry
Domain event registry for [papyrus/event-sourcing](https://github.com/papyrusphp/event-sourcing).

This package contains both an interface (the contract) as well as a simple 'in memory' implementation for a Domain event registry.  

Usable in [papyrus/event-store](https://github.com/papyrusphp/event-store).

## Installation
Install via composer:
```bash
$ composer install papyrus/domain-event-registry
```

## Configuration
Bind your own implementation or the included `InMemoryDomainEventRegistry` to the interface `DomainEventRegistry` in your service definitions, e.g.:

A plain PHP PSR-11 Container definition:

```php
use Papyrus\DomainEventRegistry\DomainEventRegistry;
use Papyrus\DomainEventRegistry\InMemory\InMemoryDomainEventRegistry;
use Psr\Container\ContainerInterface;

return [
    // Other definitions
    // ...

    DomainEventRegistry::class => static function (ContainerInterface $container): DomainEventRegistry {
        // Ideally, create a class loader (with caching) to use as input for the registry
        return new InMemoryDomainEventRegistry(
            SomeDomainEvent::class,
            AnotherDomainEvent::class,
        );
    },
];
```
A Symfony YAML-file definition:
```yaml
services:
    Papyrus\DomainEventRegistry\DomainEventRegistry:
        class: Papyrus\DomainEventRegistry\InMemory\InMemoryDomainEventRegistry
        arguments:
            - Name\Space\SomeDomainEvent
            - Name\Space\AnotherDomainEvent
```
