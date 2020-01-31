<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Task
 *
 * @ORM\Table(name="tasktemplate")
 * @ORM\Entity(repositoryClass="App\Repository\TaskTemplateRepository")
 */
class TaskTemplate
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
     * @ORM\Column(name="code", type="string", nullable=false)
     */
    protected $code;
    /**
     * @var string
     *
     * @ORM\Column(name="notes", type="text", length=16777215, nullable=true)
     */
    protected $notes;
    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Account")
     * @ORM\JoinColumn(name="accountid", referencedColumnName="id")
     */
    protected $account;
    /**
     * @var string
     *
     * @ORM\Column(name="uuid", type="string", nullable=false)
     */
    protected $uuid;


    public function toArray() {
        return ['id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'notes' => $this->notes,
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

}
