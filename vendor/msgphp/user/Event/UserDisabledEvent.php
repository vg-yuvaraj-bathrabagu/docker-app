<?php

declare(strict_types=1);

namespace MsgPhp\User\Event;

use MsgPhp\User\Entity\User;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
class UserDisabledEvent
{
    public $user;

    final public function __construct(User $user)
    {
        $this->user = $user;
    }
}
