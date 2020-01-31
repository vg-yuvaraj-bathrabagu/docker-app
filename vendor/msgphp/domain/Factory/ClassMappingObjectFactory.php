<?php

declare(strict_types=1);

namespace MsgPhp\Domain\Factory;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
final class ClassMappingObjectFactory implements DomainObjectFactoryInterface
{
    private $factory;
    private $mapping;

    public function __construct(DomainObjectFactoryInterface $factory, array $mapping)
    {
        $this->factory = $factory;
        $this->mapping = $mapping;
    }

    public function create(string $class, array $context = [])
    {
        return $this->factory->create($this->mapping[$class] ?? $class, $context);
    }
}
