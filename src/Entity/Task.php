<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Task
 *
 * @ORM\MappedSuperclass
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="istimesheettask", type="integer")
 * @ORM\DiscriminatorMap({"1" = "Task", "2" = "TaskQueue"})
 * @ORM\Table(name="task")
 * @ORM\Entity(repositoryClass="App\Repository\TaskRepository")
 */
class Task
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
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Account")
     * @ORM\JoinColumn(name="accountid", referencedColumnName="id")
     */
    protected $account;
    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User\AppUser")
     * @ORM\JoinColumn(name="assigneeid", referencedColumnName="id")
     */
    protected $assignee;
    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Project")
     * @ORM\JoinColumn(name="projectid", referencedColumnName="id")
     */
    protected $project;
    /**
     * @var integer
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Task")
     * @ORM\JoinColumn(name="parentid", referencedColumnName="id")
     */
    protected $parent;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="startdate", type="datetime", nullable=false)
     */
    protected $startdate;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="enddate", type="datetime", nullable=true)
     */
    protected $enddate;

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
     * @ORM\Column(name="title", type="string", nullable=false)
     */
    protected $title;
    /**
     * @var boolean
     *
     */
    protected $istimesheettask = 1;

    public function toArray() {
        return ['id' => $this->id,
            'assignee' => $this->assignee,
            'account' => $this->account,
            'title' => $this->title,
            'project' => $this->project,
            'parent' => $this->parent,
            'startdate' => $this->startdate,
            'enddate' => $this->enddate,
            'uuid' => $this->uuid,
            'status' => $this->status,
            'istimesheettask' => $this->istimesheettask
        ];
    }

    public function toString() {
        return (string)$this->id;
    }

    /**
     * @return int
     */
    public function getAccount(): ?int
    {
        return $this->account;
    }

    /**
     * @param int $account
     */
    public function setAccount(int $account): void
    {
        $this->account = $account;
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return \DateTime
     */
    public function getStartdate(): ?\DateTime
    {
        return $this->startdate;
    }

    /**
     * @param \DateTime $startdate
     */
    public function setStartdate(\DateTime $startdate): void
    {
        $this->startdate = $startdate;
    }

    /**
     * @return \DateTime
     */
    public function getEnddate(): ?\DateTime
    {
        return $this->enddate;
    }

    /**
     * @param \DateTime $enddate
     */
    public function setEnddate(\DateTime $enddate): void
    {
        $this->enddate = $enddate;
    }

    /**
     * @return string
     */
    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    /**
     * @param string $uuid
     */
    public function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
    }

    /**
     * @return int
     */
    public function getAssignee(): ?int
    {
        return $this->assignee;
    }

    /**
     * @param int $assignee
     */
    public function setAssignee(int $assignee): void
    {
        $this->assignee = $assignee;
    }

    /**
     * @return int
     */
    public function getProject(): ?int
    {
        return $this->project;
    }

    /**
     * @param int $project
     */
    public function setProject(int $project): void
    {
        $this->project = $project;
    }

    /**
     * @return int
     */
    public function getParent(): ?int
    {
        return $this->parent;
    }

    /**
     * @param int $parent
     */
    public function setParent(int $parent): void
    {
        $this->parent = $parent;
    }

    /**
     * @return string
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return bool
     */
    public function isIstimesheettask(): ?bool
    {
        return $this->istimesheettask;
    }

    /**
     * @param bool $istimesheettask
     */
    public function setIstimesheettask(bool $istimesheettask): void
    {
        $this->istimesheettask = $istimesheettask;
    }

    public function __toString() {
        return $this->title;
    }

}
