<?php

namespace App\Repository;

use App\Entity\Employee;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class EmployeeRepository extends ServiceEntityRepository {

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Employee::class);
    }


    public function getLogin($username, $password) {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('a.username, a.password')
            ->from('App\\Reports\\Model\\Employee', 'a')
            ->Where('a.username = :user')
            ->setParameter('user', $username)
            ->andWhere('a.password = :pass')
            ->setParameter('pass', $password);
        $query = $qb->getQuery();

        return $query->getResult(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);
    }

    public function getAllUsers() {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('a')
            ->from('App\\Reports\\Model\\Employee', 'a');
        $query = $qb->getQuery();

        return $query->getResult(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);
    }

}
