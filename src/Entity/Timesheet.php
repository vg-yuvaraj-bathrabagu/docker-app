<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Timesheet
 *
 * @ORM\Table(name="timesheet")
 * @ORM\Entity(repositoryClass="App\Repository\TimesheetRepository")
 */
class Timesheet
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
     * @ORM\JoinColumn(name="userid", referencedColumnName="id")
     */
    protected $user;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="startdate", type="datetime", nullable=false)
     */
    protected $startdate;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="enddate", type="datetime", nullable=false)
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
     * @ORM\Column(name="comments", type="text", length=16777215, nullable=true)
     */
    protected $comments;

    public function toArray() {
        return ['id' => $this->id,
            'user' => $this->user,
            'account' => $this->account,
            'startdate' => $this->startdate,
            'enddate' => $this->enddate,
            'uuid' => $this->uuid,
            'comments' => $this->comments,
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
    public function getUser(): ?int
    {
        return $this->user;
    }

    /**
     * @param int $user
     */
    public function setUser(int $user): void
    {
        $this->user = $user;
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
}
