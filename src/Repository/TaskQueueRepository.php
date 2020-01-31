<?php

namespace App\Repository;

use App\Entity\TaskQueue;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class TaskQueueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TaskQueue::class);
    }

    public function getAll($accountid) {
        // TODO: This function returns an array with empty results
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('t.id as id, t.status, t.title, p.id as project, a.id as assignee, a.firstname, a.lastname, pa.id as parent, t.startdate, t.enddate, c.title as category')
            ->from('App\\Entity\\TaskQueue', 't')
            ->leftJoin('App\\Entity\\User\\AppUser', 'a', 'WITH', 't.assignee = a.id')
            ->leftJoin('t.parent', 'pa', 'WITH', 't.parent = pa.id')
            ->leftJoin('App\\Entity\\Project', 'p', 'WITH', 't.project = p.id')
            ->leftJoin('App\\Entity\\TaskCategory', 'c', 'WITH', 't.category = c.id')
            ->where(" t.account = ".$accountid);
        $query = $qb->getQuery();

        return $query->getResult(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);
    }

    public function getUuidFromId($id) {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('a.uuid')
            ->from('App\\Entity\\TaskQueue', 'a')
            ->where("a.id = ".$id);
        $query = $qb->getQuery();

        $result = $query->getResult(\Doctrine\ORM\AbstractQuery::HYDRATE_SCALAR);

        return $result[0]['uuid'];
    }


}
