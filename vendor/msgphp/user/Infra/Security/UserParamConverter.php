<?php

declare(strict_types=1);

namespace MsgPhp\User\Infra\Security;

use MsgPhp\User\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
final class UserParamConverter implements ParamConverterInterface
{
    public const NAME = 'msgphp.current_user';

    use TokenStorageAwareTrait;

    public function apply(Request $request, ParamConverter $configuration): bool
    {
        if (!$request->attributes->has($param = $configuration->getName())) {
            $request->attributes->set($param, $this->toUser());
        }

        return true;
    }

    public function supports(ParamConverter $configuration): bool
    {
        return is_a($configuration->getClass(), User::class, true) ? ($configuration->isOptional() || $this->isUser()) : false;
    }
}
