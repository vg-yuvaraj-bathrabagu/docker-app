<?php

declare(strict_types=1);

namespace MsgPhp\Domain\Infra\InMemory;

use MsgPhp\Domain\{DomainCollectionInterface, DomainIdentityHelper};
use MsgPhp\Domain\Factory\DomainCollectionFactory;
use MsgPhp\Domain\Exception\{DuplicateEntityException, EntityNotFoundException, InvalidClassException};

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
trait DomainEntityRepositoryTrait
{
    private $class;
    private $identityHelper;
    private $memory;
    private $accessor;

    public function __construct(string $class, DomainIdentityHelper $identityHelper, GlobalObjectMemory $memory = null, ObjectFieldAccessor $accessor = null)
    {
        $this->class = $class;
        $this->identityHelper = $identityHelper;
        $this->memory = $memory ?? GlobalObjectMemory::createDefault();
        $this->accessor = $accessor ?? new ObjectFieldAccessor();
    }

    private function doFindAll(int $offset = 0, int $limit = 0): DomainCollectionInterface
    {
        return $this->createResultSet(iterator_to_array($this->memory->all($this->class)), $offset, $limit);
    }

    private function doFindAllByFields(array $fields, int $offset = 0, int $limit = 0): DomainCollectionInterface
    {
        if (!$fields) {
            throw new \LogicException('No fields provided.');
        }

        $i = -1;
        $entities = [];
        foreach ($this->memory->all($this->class) as $entity) {
            if (!$this->matchesFields($entity, $fields) || ++$i < $offset) {
                continue;
            }

            if ($limit && $i >= ($offset + $limit)) {
                break;
            }

            $entities[] = $entity;
        }

        return $this->createResultSet($entities);
    }

    /**
     * @return object
     */
    private function doFind($id)
    {
        if (!$this->identityHelper->isIdentity($this->class, $id)) {
            throw EntityNotFoundException::createForId($this->class, $id);
        }

        return $this->doFindByFields($this->identityHelper->toIdentity($this->class, $id));
    }

    /**
     * @return object
     */
    private function doFindByFields(array $fields)
    {
        if ($entity = $this->doFindAllByFields($fields)->first()) {
            return $entity;
        }

        if ($this->identityHelper->isIdentity($this->class, $fields)) {
            throw EntityNotFoundException::createForId($this->class, $fields);
        }

        throw EntityNotFoundException::createForFields($this->class, $fields);
    }

    private function doExists($id): bool
    {
        if (!$this->identityHelper->isIdentity($this->class, $id)) {
            return false;
        }

        return $this->doExistsByFields($this->identityHelper->toIdentity($this->class, $id));
    }

    private function doExistsByFields(array $fields): bool
    {
        try {
            $this->doFindByFields($fields);

            return true;
        } catch (EntityNotFoundException $e) {
            return false;
        }
    }

    /**
     * @param object $entity
     */
    private function doSave($entity): void
    {
        if (!$entity instanceof $this->class) {
            throw InvalidClassException::create(get_class($entity));
        }

        if ($this->memory->contains($entity)) {
            return;
        }

        if (null !== ($id = $this->identityHelper->getIdentity($entity)) && $this->doExists($id)) {
            throw DuplicateEntityException::createForId(get_class($entity), $id);
        }

        $this->memory->persist($entity);
    }

    /**
     * @param object $entity
     */
    private function doDelete($entity): void
    {
        if (!$entity instanceof $this->class) {
            throw InvalidClassException::create(get_class($entity));
        }

        $this->memory->remove($entity);
    }

    private function createResultSet(array $entities, int $offset = 0, int $limit = 0): DomainCollectionInterface
    {
        if ($offset || $limit) {
            $entities = array_slice($entities, $offset, $limit ?: null);
        }

        return DomainCollectionFactory::create($entities);
    }

    /**
     * @param object $entity
     */
    private function matchesFields($entity, array $fields): bool
    {
        $idFields = array_flip($this->identityHelper->getIdentifierFieldNames(get_class($entity)));
        foreach ($fields as $field => $value) {
            if (isset($idFields[$field]) && $this->identityHelper->isEmptyIdentifier($value)) {
                return false;
            }

            $knownValue = $this->identityHelper->normalizeIdentifier($this->accessor->getValue($entity, $field));

            if (is_array($value)) {
                $value = array_map(function ($v) {
                    return $this->identityHelper->normalizeIdentifier($v);
                }, $value);

                if (null === $knownValue || !in_array($knownValue, $value)) {
                    return false;
                }

                continue;
            }

            $value = $this->identityHelper->normalizeIdentifier($value);

            if (null === $value xor null === $knownValue) {
                return false;
            }

            if ($value == $knownValue) {
                continue;
            }

            return false;
        }

        return true;
    }
}
