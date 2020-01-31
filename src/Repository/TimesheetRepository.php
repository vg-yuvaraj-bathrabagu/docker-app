<?php

namespace App\Repository;

use App\Entity\Timesheet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class TimesheetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Timesheet::class);
    }

    public function getAll($accountid) {
        // TODO: This function returns an array with empty results
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('t.id, t.startdate, t.enddate, u.firstname, u.lastname')
            ->from('App\\Entity\\Timesheet', 't')
            ->from('App\\Entity\\User\\AppUser', 'u')
            ->where("t.user = u.id AND t.account = ".$accountid);
        $query = $qb->getQuery();

        return $query->getResult(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);
    }

    public function getUuidFromId($id) {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('a.uuid')
            ->from('App\\Entity\\Timesheet', 'a')
            ->where("a.id = ".$id);
        $query = $qb->getQuery();

        $result = $query->getResult(\Doctrine\ORM\AbstractQuery::HYDRATE_SCALAR);

        return $result[0]['uuid'];
    }

}
