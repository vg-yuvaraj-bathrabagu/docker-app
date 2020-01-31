<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Task
 *
 * @ORM\Table(name="tasktemplatedetail")
 * @ORM\Entity(repositoryClass="App\Repository\TaskTemplateDetailRepository")
 */
class TaskTemplateDetail
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
     * @ORM\Column(name="name", type="string", nullable=false)
     */
    protected $name;
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", nullable=false)
     */
    protected $description;
    /**
     * @var string
     *
     * @ORM\Column(name="dependency", type="string", nullable=false)
     */
    protected $dependency;
    /**
     * @var integer
     *
     * @ORM\Column(name="duration", type="integer", nullable=true)
     */
    protected $duration = 1;
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Account")
     * @ORM\JoinColumn(name="accountid", referencedColumnName="id")
     */
    protected $account;
    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\TaskTemplate")
     * @ORM\JoinColumn(name="tasktemplateid", referencedColumnName="id")
     */
    protected $tasktemplate;



    public function toArray() {
        return ['id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'dependency' => $this->dependency,
            "duration" => $this->duration,
            "assignee" => $this->assignee,
            'account' => $this->account,
            'uuid' => $this->uuid,
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

    public function __toString() {
        return $this->name;
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

}
