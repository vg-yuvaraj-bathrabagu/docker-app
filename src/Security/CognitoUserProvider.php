<?php


namespace App\Security;

use App\Bridge\AwsCognitoClient;
use MsgPhp\Domain\Exception\EntityNotFoundException;
use MsgPhp\Domain\Factory\EntityAwareFactoryInterface;
use MsgPhp\User\Entity\User;
use MsgPhp\User\Infra\Security\SecurityUser;
use MsgPhp\User\Infra\Security\UserRolesProviderInterface;
use MsgPhp\User\Repository\UserRepositoryInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

/**
 *
 * The code in this class is adapted from MsgPhp\User\Infra\Security\SecurityUserProvider with the
 * addition of cognito based authentication for the username
 *
 * Class CognitoUserProvider
 * @package App\Security
 */
class CognitoUserProvider implements UserProviderInterface
{
    /**
     * @var AWSCognitoClient
     */
    private $cognitoClient;

    public const DEFAULT_ROLE = 'ROLE_USER';

    private $repository;
    private $factory;
    private $rolesProvider;

    public function __construct(AWSCognitoClient $cognitoClient, UserRepositoryInterface $repository, EntityAwareFactoryInterface $factory, UserRolesProviderInterface $rolesProvider = null)
    {
        $this->repository = $repository;
        $this->factory = $factory;
        $this->rolesProvider = $rolesProvider;
        $this->cognitoClient = $cognitoClient;
    }

    public function loadUserByUsername($username)
    {
        try {
            $result = $this->cognitoClient->findByUsername($username);

            if (count($result['Users']) === 0) {
                throw new UsernameNotFoundException("Invalid credentials");
            }
            $user = $this->repository->findByUsername($username);
        } catch (EntityNotFoundException $e) {
            throw new UsernameNotFoundException($e->getMessage());
        }

        return $this->fromUser($user);
    }

    public function refreshUser(UserInterface $user): UserInterface
    {
        if (!$user instanceof SecurityUser) {
            throw new UnsupportedUserException(sprintf('Unsupported user "%s".', get_class($user)));
        }

        try {
            $user = $this->repository->find($this->factory->identify(User::class, $user->getUsername()));
        } catch (EntityNotFoundException $e) {
            throw new UsernameNotFoundException($e->getMessage());
        }

        return $this->fromUser($user);
    }

    public function supportsClass($class): bool
    {
        return SecurityUser::class === $class;
    }

    public function fromUser(User $user): SecurityUser
    {
        return new SecurityUser($user, $this->rolesProvider ? $this->rolesProvider->getRoles($user) : [self::DEFAULT_ROLE]);
    }
}