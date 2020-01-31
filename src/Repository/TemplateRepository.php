<?php

namespace App\Repository;

use App\Entity\Template;
use App\Helper\Utils;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class TemplateRepository extends ServiceEntityRepository {
    use Utils;

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Template::class);
    }

    public function getAll($accountid) {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('t')
            ->from('App\\Entity\\Template', 't')
            ->where("t.account = ".$accountid);
        $query = $qb->getQuery();

        return $query->getResult(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);
    }

    public function getUuidFromId($id) {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('t.uuid')
            ->from('App\\Entity\\Template', 't')
            ->where("t.id = ".$id);
        $query = $qb->getQuery();
        $result = $query->getResult(\Doctrine\ORM\AbstractQuery::HYDRATE_SCALAR);

        return $result[0]['uuid'];
    }

    function getActiveTemplatesArray() {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('t.id, t.name')
            ->from('App\\Entity\\Template', 't')
            ->where("t.isactive = 1");
        $query = $qb->getQuery();
        return $query->getResult(\Doctrine\ORM\AbstractQuery::HYDRATE_SCALAR);
    }

    public function getTemplateName($id) {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('t.name')
            ->from('App\\Entity\\Template', 't')
            ->where("t.id = ".$id);
        $query = $qb->getQuery();

        $result = $query->getResult(\Doctrine\ORM\AbstractQuery::HYDRATE_SCALAR);

        return $result[0]['name'];
    }

    /**
     * Get the Nexus template for the specified account
     * @param $accountid
     *
     * @return The nexus temmplate for the account
     */
    public function getNexusTemplateForAccount($accountid)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('t')
            ->from('App\\Entity\\Template', 't')
            ->where("t.account = ".$accountid." and t.tablename='nexus".$accountid."'");
        $query = $qb->getQuery();

        return array($query->getOneOrNullResult(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY));
    }

}
