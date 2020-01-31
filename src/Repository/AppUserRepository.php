<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use MsgPhp\User\Infra\Doctrine\Repository\UserRepository;
use Symfony\Component\Security\Core\Security;

class AppUserRepository extends ServiceEntityRepository
{
    protected $security;
    protected $msgphpUserRepository;

    public function __construct(ManagerRegistry $registry, Security $security, UserRepository $msgphpUserRepository)
    {
        parent::__construct($registry, User\AppUser::class);
        $this->security = $security;
        $this->msgphpUserRepository = $msgphpUserRepository;
    }

    public function getAll($accountid) {
        $account_filter = "";
        if (!$this->security->isGranted('ROLE_SUPER_ADMIN')) {
            $account_filter = " WHERE au.account  =".$accountid;
        }

        $query = $this->getEntityManager()->createQuery("SELECT au, a, r FROM App\\Entity\\User\\AppUser au JOIN au.roles r JOIN au.account a ".$account_filter);

        return $query->getResult(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);
    }

    public function getUuidFromId($id) {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('a.uuid')
            ->from('App\\Entity\\User\\AppUser', 'a')
            ->where("a.id = ".$id);
        $query = $qb->getQuery();

        $result = $query->getResult(\Doctrine\ORM\AbstractQuery::HYDRATE_SCALAR);

        return $result[0]['uuid'];
    }

    /**
     * Get the account_id for the specified user which is used for filtering queries
     *
     * @param $user the instance of the SecurityUser loaded from the security token
     * @return The accountid for the user
     */
    public function getAccountIdForUser($user) {
        $appuser = $this->find($user->getUsername()); // the username for the SecurityUser is the userid
        return $appuser->getAccount()->getId();
    }

    /**
     * Get the account_id for the specified user which is used for filtering queries
     *
     * @param $user the instance of the SecurityUser loaded from the security token
     * @return Account
     */
    public function getAccountForUser($user): Account {
        $appuser = $this->find($user->getUsername()); // the username for the SecurityUser is the userid
        return $appuser->getAccount();
    }
    /**
     * Find the user by email or user name 
     * 
     * @param $nickname
     * @return App_User
     */
    public function findUserByEmailorUsername($nickname)
    {
        return $this->msgphpUserRepository->findByUsername($nickname);
    }

}
