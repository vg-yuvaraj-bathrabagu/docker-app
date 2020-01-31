<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CustomReport
 *
 * @ORM\Table(name="hadoop_status")
 * @ORM\Entity(repositoryClass="App\Reports\Repository\HadoopStatusRepository")
 */
class HadoopStatus
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="module", type="string", length=30, nullable=false)
     */
    private $module;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="text", length=16777215, nullable=false)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="category", type="string", length=200, nullable=false)
     */
    private $category;

    /**
     * @var string
     *
     * @ORM\Column(name="comments", type="string", length=255, nullable=false)
     */
    private $comments;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ts_begin", type="datetime", nullable=false)
     */
    private $ts_begin;

    /**
     * @var integer
     *
     * @ORM\Column(name="nodes", type="integer", nullable=false)
     */
    private $nodes;
    /**
     * @var string
     *
     * @ORM\Column(name="uuid", type="string", nullable=false)
     */
    protected $uuid;
    /**
     * @var string
     *
     * @ORM\Column(name="statusresult", type="text", length=16777215, nullable=true)
     */
    protected $statusresult;
    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", nullable=false)
     */
    protected $color;
    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Account")
     * @ORM\JoinColumn(name="accountid", referencedColumnName="id")
     */
    protected $account;

    public function toArray() {
        return ['id' => $this->id,
            'module' => $this->module,
            'category' => $this->category,
            'description' => $this->description,
            'comments' => $this->comments,
            'nodes' => $this->nodes,
            'status' => $this->status,
            'uuid' => $this->uuid,
            'color' => $this->color,
            'statusresult' => $this->statusresult
        ];
    }

    public function toString() {
        return (string)$this->id;
    }


}
