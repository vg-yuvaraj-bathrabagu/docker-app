<?php

namespace App\Repository;

use App\Entity\StateGuide;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class StateGuideRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StateGuide::class);
    }

    public function getAll($accountid) {
        // TODO: This function returns an array with empty results
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('sg')
            ->from('App\\Entity\\StateGuide', 'sg')
            ->where("sg.account IN (1, ".$accountid.")");
        $query = $qb->getQuery();

        return $query->getResult(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);
    }

    public function getUuidFromId($id) {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('sg.uuid')
            ->from('App\\Entity\\StateGuide', 'sg')
            ->where("sg.id = ".$id);
        $query = $qb->getQuery();

        $result = $query->getResult(\Doctrine\ORM\AbstractQuery::HYDRATE_SCALAR);

        return $result[0]['uuid'];
    }

    public function getStateName($id) {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('sg.state')
            ->from('App\\Entity\\StateGuide', 'sg')
            ->where("sg.id = ".$id);
        $query = $qb->getQuery();

        $result = $query->getResult(\Doctrine\ORM\AbstractQuery::HYDRATE_SCALAR);

        return $result[0]['state'];
    }
}
