<?php

declare(strict_types=1);

namespace MsgPhp\Domain\Infra\Doctrine;

use Doctrine\Common\Persistence\Mapping\ClassMetadata;
use Doctrine\ORM\EntityManagerInterface;
use MsgPhp\Domain\{DomainIdentityMappingInterface, DomainIdInterface};
use MsgPhp\Domain\Exception\InvalidClassException;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
final class DomainIdentityMapping implements DomainIdentityMappingInterface
{
    private $em;
    private $classMapping;

    public function __construct(EntityManagerInterface $em, array $classMapping = [])
    {
        $this->em = $em;
        $this->classMapping = $classMapping;
    }

    public function getIdentifierFieldNames(string $class): array
    {
        return $this->getMetadata($class)->getIdentifierFieldNames();
    }

    public function getIdentity($object): array
    {
        return array_filter($this->getMetadata(get_class($object))->getIdentifierValues($object), function ($value) {
            if ($value instanceof DomainIdInterface) {
                return !$value->isEmpty();
            }

            if (is_object($value)) {
                return (bool) $this->getIdentity($value);
            }

            return null !== $value;
        });
    }

    private function getMetadata(string $class): ClassMetadata
    {
        $class = $this->classMapping[$class] ?? $class;

        if (!class_exists($class) || $this->em->getMetadataFactory()->isTransient($class)) {
            throw InvalidClassException::create($class);
        }

        return $this->em->getClassMetadata($class);
    }
}
