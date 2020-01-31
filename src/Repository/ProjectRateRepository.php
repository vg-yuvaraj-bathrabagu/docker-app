<?php

namespace App\Repository;

use App\Entity\ProjectRate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class ProjectRateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProjectRate::class);
    }

    public function getAll($accountid) {
        // TODO: This function returns an array with empty results
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('a.id, a.startdate, a.enddate, p.title as project_title, u.firstname, u.lastname, a.clientrate, a.contractorrate, a.agencyrate, a.overtimerate, a.premiumrate, a.doublerate, a.triplerate, a.dailyrate, a.weeklyrate, a.monthlyrate, a.notes ')
            ->from('App\\Entity\\ProjectRate', 'a')
            ->from('App\\Entity\\Project', 'p')
            ->from('App\\Entity\\User\\AppUser', 'u')
            ->where(" a.project = p.id AND a.user = u.id AND a.account = ".$accountid);
        $query = $qb->getQuery();

        return $query->getResult(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);
    }

    public function getUuidFromId($id) {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('a.uuid')
            ->from('App\\Entity\\ProjectRate', 'a')
            ->where("a.id = ".$id);
        $query = $qb->getQuery();

        $result = $query->getResult(\Doctrine\ORM\AbstractQuery::HYDRATE_SCALAR);

        return $result[0]['uuid'];
    }
}
