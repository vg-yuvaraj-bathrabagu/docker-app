<?php

namespace App\Repository;

use App\Entity\Account;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Security;

class AccountRepository extends ServiceEntityRepository {

    private $security;

    public function __construct(ManagerRegistry $registry, Security $security)
    {
        parent::__construct($registry, Account::class);
        $this->security = $security;
    }
    public function getAll($accountid) {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('a')
            ->from('App\\Entity\\Account', 'a');

        if (!$this->security->isGranted('ROLE_SUPER_ADMIN')) {
            $qb->where("a.id = ".$accountid);
        }
        $query = $qb->getQuery();

        return $query->getResult(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);
    }

    public function getUuidFromId($id) {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('a.uuid')
            ->from('App\\Entity\\Account', 'a')
            ->where("a.id = ".$id);
        $query = $qb->getQuery();

        $result = $query->getResult(\Doctrine\ORM\AbstractQuery::HYDRATE_SCALAR);

        return $result[0]['uuid'];
    }
}
