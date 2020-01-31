<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * File Watcher
 *
 * @ORM\Table(name="fileupload")
 * @ORM\Entity(repositoryClass="App\Repository\FileUploadRepository")
 */
class FileUpload extends Base
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
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="folder", type="string", length=1000, nullable=false)
     */
    protected $folder;

    /**
     * @var integer
     *
     * @ORM\Column(name="templateid", type="integer", nullable=false)
     */
    protected $templateid;
    /**
     * @var integer
     *
     * @ORM\Column(name="size", type="integer", nullable=false)
     */
    protected $size;

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
     * @ORM\Column(name="uploadedby", type="bigint", nullable=false)
     */
    protected $uploadedby;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    protected $date;
    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Account")
     * @ORM\JoinColumn(name="accountid", referencedColumnName="id")
     */
    protected $account;
    /**
     * @var boolean
     *
     * @ORM\Column(name="trash", type="boolean", nullable=false)
     */
    protected $trash;

    public function toArray() {
        return ['id' => $this->id,
                'name' => $this->name,
                'folder' => $this->folder,
                'templateid' => $this->templateid,
                'size' => $this->size,
                'status' => $this->status,
                'date' => $this->date,
                'uuid' => $this->uuid,
                'color' => $this->color,
                'statusresult' => $this->statusresult,
            'uploadedby' => $this->uploadedby,
            'trash' => $this->trash
        ];
    }

    public function toString() {
        return (string)$this->id;
    }


}
