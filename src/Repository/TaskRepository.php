<?php

namespace App\Repository;

use App\Entity\Task;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class TaskRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Task::class);
    }

    public function getAll($accountid) {
        // TODO: This function returns an array with empty results
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('t.id as id, t.title, p.id as project, a.id as assignee, pa.id as parent, t.startdate, t.enddate, p.title as project_title')
            ->from('App\\Entity\\Task', 't')
            ->leftJoin('App\\Entity\\User\\AppUser', 'a', 'WITH', 't.assignee = a.id')
            ->leftJoin('App\\Entity\\Task', 'pa', 'WITH', 't.parent = pa.id')
            ->join('App\\Entity\\Project', 'p', 'WITH', 't.project = p.id')
            ->where(" t.account = ".$accountid);
        $query = $qb->getQuery();

        return $query->getResult(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);
    }

    public function getUuidFromId($id) {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('a.uuid')
            ->from('App\\Entity\\Task', 'a')
            ->where("a.id = ".$id);
        $query = $qb->getQuery();

        $result = $query->getResult(\Doctrine\ORM\AbstractQuery::HYDRATE_SCALAR);

        return $result[0]['uuid'];
    }


}
