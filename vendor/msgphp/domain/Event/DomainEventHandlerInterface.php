<?php

declare(strict_types=1);

namespace MsgPhp\Domain\Event;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
interface DomainEventHandlerInterface
{
    public function handleEvent(DomainEventInterface $event): bool;
}
