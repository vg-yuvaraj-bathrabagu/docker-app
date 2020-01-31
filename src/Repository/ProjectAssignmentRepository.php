<?php

namespace App\Repository;

use App\Entity\ProjectAssignment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Security;

class ProjectAssignmentRepository extends ServiceEntityRepository
{
    protected $security;

    public function __construct(ManagerRegistry $registry, Security $security)
    {
        parent::__construct($registry, ProjectAssignment::class);
        $this->security = $security;
    }

    public function getAll($accountid, $userid = '', $weekstartdate = '', $weekenddate='') {
        // TODO: This function returns an array with empty results
        $user_and_date_filter = '';
        if (!empty($userid)) {
            $user_and_date_filter.= " AND a.user = ".$userid;
        }
        if (!empty($weekstartdate) AND !empty($weekenddate)) {
            $user_and_date_filter.= " AND (a.startdate <='".$weekenddate."')  AND (a.enddate IS NULL OR a.enddate >= '".$weekstartdate."') ";
        }
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('a.id, a.startdate, a.enddate, a.description,  a.approvername, a.approveremail, p.id as projectid, u.id as userid, p.title, u.firstname, u.lastname, a.saturdayworkallowed, a.sundayworkallowed, a.publicholidayworkallowed, a.overtimeallowed, a.maximumhoursperday, a.maximumhoursperweek, p.builtin, t.title as task, t.id as taskid')
            ->from('App\\Entity\\ProjectAssignment', 'a')
            ->from('App\\Entity\\Project', 'p')
            ->from('App\\Entity\\Task', 't')
            ->from('App\\Entity\\User\\AppUser', 'u')
            ->where(" a.project = p.id AND t.project = p.id AND a.user = u.id AND a.account = ".$accountid." ".$user_and_date_filter);

        $query = $qb->getQuery();

        return $query->getResult(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);
    }

    public function getUuidFromId($id) {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('a.uuid')
            ->from('App\\Entity\\ProjectAssignment', 'a')
            ->where("a.id = ".$id);
        $query = $qb->getQuery();

        $result = $query->getResult(\Doctrine\ORM\AbstractQuery::HYDRATE_SCALAR);

        return $result[0]['uuid'];
    }


}
