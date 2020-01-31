<?php

namespace App\Repository;

use App\Entity\Notification;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class NotificationRepository extends ServiceEntityRepository {

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Notification::class);
    }

    public function getAllNotification($user) {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('a')
            ->from('App\\Entity\\Notification', 'a')
            ->Where('a.user = :user')->setMaxResults(10)
            ->addOrderBy('a.datecreated', 'DESC')
            ->setParameter(':user', $user);
        $query = $qb->getQuery();

        return $query->getResult(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);
    }

    /**
     *
     * Mark a notification as read
     *
     * @param $id The numeric id of the notification
     */
    public function markNotificationRead($id)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->update('App\\Entity\\Notification n SET n.isread = 1 WHERE n.id = '.$id);
        $query = $qb->getQuery();

        return $query->execute();
    }

}
