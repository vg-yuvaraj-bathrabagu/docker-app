<?php

namespace App\Repository;

use App\Entity\CustomReport;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use MsgPhp\User\Infra\Security\SecurityUser;
use Symfony\Component\Security\Core\Security;

class CustomReportRepository extends ServiceEntityRepository
{
    private $security;

    public function __construct(ManagerRegistry $registry, Security $security)
    {
        parent::__construct($registry, CustomReport::class);
        $this->security = $security;
    }

    public function getAll(SecurityUser $user, $accountid) {
        $query_filter = "";
        if ($this->security->isGranted('ROLE_SUPER_ADMIN') or $this->security->isGranted('ROLE_ADMIN')) {

        } else {
            // users can only see their queries
            $query_filter = " AND ((a.type = 'User' AND a.createdby = ".$user->getUsername().") OR a.type = 'Core') ";

        }
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('a')
            ->from('App\\Entity\\CustomReport', 'a')
            ->where("a.account = ".$accountid. " ".$query_filter);
        $query = $qb->getQuery();

        return $query->getResult(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);
    }

    public function getUuidFromId($id) {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('a.uuid')
            ->from('App\\Entity\\CustomReport', 'a')
            ->where("a.id = ".$id);
        $query = $qb->getQuery();

        $result = $query->getResult(\Doctrine\ORM\AbstractQuery::HYDRATE_SCALAR);

        return $result[0]['uuid'];
    }

    public function getAthenaOutput($id) {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('a.athenaoutput')
            ->from('App\\Entity\\CustomReport', 'a')
            ->where("a.id = ".$id);
        $query = $qb->getQuery();

        $result = $query->getResult(\Doctrine\ORM\AbstractQuery::HYDRATE_SCALAR);

        return $result[0]['athenaoutput'];
    }


}
