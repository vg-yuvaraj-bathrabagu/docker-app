<?php

namespace App\Repository;

use App\Entity\MPPStatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class MPPStatusRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MPPStatus::class);
    }

    public function getAll($accountid) {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('a')
            ->from('App\\Entity\\MPPStatus', 'a')
            ->where("a.account = ".$accountid);
        $query = $qb->getQuery();

        return $query->getResult(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);
    }

    public function getUuidFromId($id) {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('a.uuid')
            ->from('App\\Entity\\MPPStatus', 'a')
            ->where("a.id = ".$id);
        $query = $qb->getQuery();

        $result = $query->getResult(\Doctrine\ORM\AbstractQuery::HYDRATE_SCALAR);

        return $result[0]['uuid'];
    }

}