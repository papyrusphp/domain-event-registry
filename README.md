# 📜 Papyrus Domain event registry
[![Build Status](https://scrutinizer-ci.com/g/papyrusphp/domain-event-registry/badges/build.png?b=main)](https://github.com/papyrusphp/domain-event-registry/actions)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/papyrusphp/domain-event-registry.svg?style=flat)](https://scrutinizer-ci.com/g/papyrusphp/domain-event-registry/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/papyrusphp/domain-event-registry.svg?style=flat)](https://scrutinizer-ci.com/g/papyrusphp/domain-event-registry)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat)](LICENSE)
[![Packagist Version](https://img.shields.io/packagist/v/papyrus/domain-event-registry.svg?style=flat&include_prereleases)](https://packagist.org/packages/papyrus/domain-event-registry)
[![PHP Version](https://img.shields.io/badge/php-%5E8.1-8892BF.svg?style=flat)](http://www.php.net)

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
  _defaults:
    autowire: true
    autoconfigure: true

  # Other definitions
  # ...
  
  Papyrus\DomainEventRegistry\DomainEventRegistry:
    class: Papyrus\DomainEventRegistry\InMemory\InMemoryDomainEventRegistry
      arguments:
        # Ideally, create a class loader (with caching) to use as input for the registry
        $eventClassNames:
          - Name\Space\SomeDomainEvent
          - Name\Space\AnotherDomainEvent
```
