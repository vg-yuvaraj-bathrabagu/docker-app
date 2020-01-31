<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * File Watcher
 *
 * @ORM\Table(name="filewatcher")
 * @ORM\Entity(repositoryClass="App\Repository\FileWatcherRepository")
 */
class FileWatcher extends Base
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=30, nullable=false)
     */
    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    protected $description;

    /**
     * @var string
     *
     * @ORM\Column(name="querystring", type="text", length=16777215, nullable=false)
     */
    protected $querystring;

    /**
     * @var string
     *
     * @ORM\Column(name="category", type="string", length=200, nullable=false)
     */
    protected $category;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datecreated", type="datetime", nullable=false)
     */
    protected $datecreated;

    /**
     * @var integer
     *
     * @ORM\Column(name="createdby", type="bigint", nullable=false)
     */
    protected $createdby;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="lastupdatedon", type="datetime", nullable=true)
     */
    protected $lastupdatedon;

    /**
     * @var integer
     *
     * @ORM\Column(name="lastupdatedby", type="bigint", nullable=true)
     */
    protected $lastupdatedby;

    /**
     * @var boolean
     *
     * @ORM\Column(name="issendemail", type="boolean", nullable=false)
     */
    protected $issendemail;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isactive", type="boolean", nullable=false)
     */
    protected $isactive;

    /**
     * @var string
     *
     * @ORM\Column(name="expirytype", type="string", length=255, nullable=false)
     */
    protected $expirytype;

    /**
     * @var string
     *
     * @ORM\Column(name="expirydate", type="string", length=255, nullable=false)
     */
    protected $expirydate;

    /**
     * @var string
     *
     * @ORM\Column(name="postpone", type="string", nullable=false)
     */
    protected $postpone;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    protected $date;

    /**
     * @var string
     *
     * @ORM\Column(name="bucket", type="string", nullable=false)
     */
    protected $bucket;
    /**
     * @var string
     *
     * @ORM\Column(name="uuid", type="string", nullable=false)
     */
    protected $uuid;
    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", nullable=false)
     */
    protected $status;
    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", nullable=false)
     */
    protected $color;
    /**
     * @var string
     *
     * @ORM\Column(name="statusresult", type="text", length=16777215, nullable=true)
     */
    protected $statusresult;
        /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Account")
     * @ORM\JoinColumn(name="accountid", referencedColumnName="id")
     */
    protected $account;
    /**
     * @var integer
     *
     * @ORM\Column(name="simulationid", type="integer", nullable=true)
     */
    protected $simulationid;
    /**
     * @var integer
     *
     * @ORM\Column(name="templateid", type="integer", nullable=true)
     */
    protected $templateid;
    /**
     * @var string
     *
     * @ORM\Column(name="securitypolicy", type="text", length=16777215, nullable=true)
     */
    protected $securitypolicy;
    /**
     * @var string
     *
     * @ORM\Column(name="schedule", type="text", length=16777215, nullable=true)
     */
    protected $schedule;

    public function toArray() {
        return ['id' => $this->id,
                'title' => $this->title,
                'category' => $this->category,
                'description' => $this->description,
                'querystring' => $this->querystring,
                'bucket' => $this->bucket,
                'uuid' => $this->uuid,
                'color' => $this->color,
                'statusresult' => $this->statusresult,
                'simulationid' => $this->simulationid,
                'templateid' => $this->templateid,
                'securitypolicy' => $this->securitypolicy,
                'schedule' => $this->schedule
        ];
    }

    public function toString() {
        return (string)$this->id;
    }


}
