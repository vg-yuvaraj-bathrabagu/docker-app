<?php

declare(strict_types=1);

namespace MsgPhp\User\Password;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
final class PasswordSalt
{
    public $token;
    public $iterations;
    public $format;

    public function __construct(string $token, int $iterations = 5000, string $format = '%s{%s}')
    {
        $this->token = $token;
        $this->iterations = $iterations;
        $this->format = $format;
    }
}
