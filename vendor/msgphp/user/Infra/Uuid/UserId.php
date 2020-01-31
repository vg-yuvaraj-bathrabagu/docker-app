<?php

declare(strict_types=1);

namespace MsgPhp\User\Infra\Uuid;

use MsgPhp\Domain\Infra\Uuid\DomainId;
use MsgPhp\User\UserIdInterface;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
final class UserId extends DomainId implements UserIdInterface
{
}
