<?php

namespace App\Repository;


use App\Entity\Employeerelationship;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class EmployeeRelationshipRepository extends ServiceEntityRepository {

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Employeerelationship::class);
    }

    public function getPermissions() {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('a')
            ->from('App\\Entity\\Employeerelationship', 'a');
            $qb->join('App\\Entity\\Employee', 'ae', \Doctrine\ORM\Query\Expr\Join::WITH, 'a.employeeid = ae.id');
        $query = $qb->getQuery();

        return $query->getResult(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);
    }
}
