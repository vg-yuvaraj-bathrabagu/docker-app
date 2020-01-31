<?php

declare(strict_types=1);

namespace MsgPhp\User\Entity\Credential\Features;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
trait EmailAsUsername
{
    /** @var string */
    private $email;

    public static function getUsernameField(): string
    {
        return 'email';
    }

    public function getUsername(): string
    {
        return $this->email;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    abstract public function withEmail(string $email): self;
}
