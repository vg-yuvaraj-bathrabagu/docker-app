<?php

declare(strict_types=1);

namespace MsgPhp\Domain\Projection;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
final class ProjectionDocumentProvider implements \IteratorAggregate
{
    private $transformer;
    private $dataProviders;

    /**
     * @param callable[] $dataProviders
     */
    public function __construct(ProjectionDocumentTransformerInterface $transformer, iterable $dataProviders)
    {
        $this->transformer = $transformer;
        $this->dataProviders = $dataProviders;
    }

    public function getIterator(): \Traversable
    {
        foreach ($this->dataProviders as $dataProvider) {
            foreach ($dataProvider() as $object) {
                try {
                    $document = $this->transformer->transform($object);
                } catch (\Throwable $e) {
                    $document = new ProjectionDocument();
                    $document->status = ProjectionDocument::STATUS_FAILED_TRANSFORMATION;
                    $document->source = $object;
                    $document->error = $e;
                }

                yield $document;
            }
        }
    }
}
