<?php

namespace App\Repository;

use App\Entity\FileUpload;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use MsgPhp\User\Infra\Security\SecurityUser;
use Symfony\Component\Security\Core\Security;

class FileUploadRepository extends ServiceEntityRepository
{
    private $security;

    public function __construct(ManagerRegistry $registry, Security $security)
    {
        parent::__construct($registry, FileUpload::class);
        $this->security = $security;
    }

    /**
     *
     * Load all the files uploaded by the specific user or those in the shared folder
     * @param SecurityUser $user
     * @return mixed
     */
    public function getAllForUser(SecurityUser $user, $accountid) {
        $file_filter = "";
        if ($this->security->isGranted('ROLE_SUPER_ADMIN') or $this->security->isGranted('ROLE_ADMIN')) {
            // $file_filter = " f.account =  ".$this->appUserRepository->getAccountIdForUser($user);

        } else {
            // users can see their files including those in trash
            $file_filter = " AND (f.uploadedby = ".$user->getUsername()." OR f.folder LIKE '%shared/%' OR (f.trash = 1 AND f.uploadedby =".$user->getUsername().")) ";
            // if a user has restore_shared_data permission then they can see the trash files from the shared folder
            if ($this->security->isGranted('ROLE_SUPER_ADMIN')) {
                $file_filter .= " OR (f.account = ".$accountid." AND f.folder LIKE '%shared/%') ";
            }

        }
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('f.id, f.name, f.folder, f.templateid, f.size, f.uuid, f.status, f.color, f.date, f.uploadedby, f.statusresult, f.trash, t.name as templatename, t.bucketinput, au.firstname, au.lastname, t.type as templatetype')
            ->from('App\\Entity\\FileUpload', 'f')
            ->from('App\\Entity\\Template', 't')
            ->from('App\\Entity\\User\\AppUser', 'au')
            ->from('App\\Entity\\Account', 'ac')
            ->where("f.templateid = t.id AND f.uploadedby = au.id AND f.account = ac.id AND f.account = ".$accountid." ".$file_filter);
        $query = $qb->getQuery();

        return $query->getResult(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);
    }

    public function getUuidFromId($id) {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('f.uuid')
            ->from('App\\Entity\\FileUpload', 'a')
            ->where("f.id = ".$id);
        $query = $qb->getQuery();

        $result = $query->getResult(\Doctrine\ORM\AbstractQuery::HYDRATE_SCALAR);

        return $result[0]['uuid'];
    }

}
