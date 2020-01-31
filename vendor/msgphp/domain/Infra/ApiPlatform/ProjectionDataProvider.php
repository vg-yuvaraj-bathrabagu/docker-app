<?php

declare(strict_types=1);

namespace MsgPhp\Domain\Infra\ApiPlatform;

use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use MsgPhp\Domain\Projection\{ProjectionInterface, ProjectionRepositoryInterface, ProjectionTypeRegistryInterface};

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
final class ProjectionDataProvider implements CollectionDataProviderInterface, ItemDataProviderInterface, RestrictedDataProviderInterface
{
    private $typeRegistry;
    private $repository;

    public function __construct(ProjectionTypeRegistryInterface $typeRegistry, ProjectionRepositoryInterface $repository)
    {
        $this->typeRegistry = $typeRegistry;
        $this->repository = $repository;
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return in_array($resourceClass, $this->typeRegistry->all(), true);
    }

    /**
     * @return ProjectionInterface[]
     */
    public function getCollection(string $resourceClass, string $operationName = null): iterable
    {
        foreach ($this->repository->findAll($resourceClass) as $document) {
            yield $document->toProjection();
        }
    }

    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): ?ProjectionInterface
    {
        $document = $this->repository->find($resourceClass, $id);

        return null === $document ? null : $document->toProjection();
    }
}
