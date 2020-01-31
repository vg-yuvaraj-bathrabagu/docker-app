<?php

namespace App\Repository;

use App\Entity\TimesheetDetail;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class TimesheetDetailRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TimesheetDetail::class);
    }

    public function getAll($accountid) {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('a')
            ->from('App\\Entity\\TimesheetDetail', 'a')
            ->where("a.account = ".$accountid);
        $query = $qb->getQuery();

        return $query->getResult(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);
    }

    public function getFromTimesheet($timesheetid) {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('t.workday, t.hours, p.title, pa.id as projectassignmentid, ta.title as task')
            ->from('App\\Entity\\TimesheetDetail', 't')
            ->from('App\\Entity\\Project', 'p')
            ->from('App\\Entity\\Task', 'ta')
            ->from('App\\Entity\\ProjectAssignment', 'pa')
            ->where("t.project = p.id AND t.task = ta.id AND t.projectassignment = pa.id AND t.timesheet = ".$timesheetid)
            ->orderBy("t.timesheet", "ASC");
        $query = $qb->getQuery();

        // this result is for a list of timesheet details, however to display it on the page
        // it needs to be organized into a multi-dimensional array as follows
        // data[projectassignment][workday][hours]
        $results = $query->getResult(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);

        $data = [];
        foreach ($results as $value) {
            $data[$value['projectassignmentid']][$value['task']][date("N", $value['workday']->getTimestamp())] = $value['hours'];
            $data[$value['projectassignmentid']][$value['task']]['title'] = $value['title'];
            $data[$value['projectassignmentid']][$value['task']]['task'] = $value['task'];
        }

        return $data;
    }
}
