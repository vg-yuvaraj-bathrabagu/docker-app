<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Project Assignments to Employees
 *
 * @ORM\Table(name="project_assignment")
 * @ORM\Entity(repositoryClass="App\Repository\ProjectAssignmentRepository")
 */
class ProjectAssignment
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Project")
     * @ORM\JoinColumn(name="projectid", referencedColumnName="id")
     */
    protected $project;
    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Task")
     * @ORM\JoinColumn(name="taskid", referencedColumnName="id")
     */
    protected $task;
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
     * @var boolean
     *
     * @ORM\Column(name="saturdayworkallowed", type="boolean", nullable=false)
     */
    protected $saturdayworkallowed = false;
    /**
     * @var boolean
     *
     * @ORM\Column(name="sundayworkallowed", type="boolean", nullable=false)
     */
    protected $sundayworkallowed = false;
    /**
     * @var boolean
     *
     * @ORM\Column(name="publicholidayworkallowed", type="boolean", nullable=false)
     */
    protected $publicholidayworkallowed = false;
    /**
     * @var boolean
     *
     * @ORM\Column(name="overtimeallowed", type="boolean", nullable=false)
     */
    protected $overtimeallowed = false;
    /**
     * @var decimal
     *
     * @ORM\Column(name="maximumhoursperday", type="decimal", precision=2, scale=1, nullable=false)
     */
    protected $maximumhoursperday = 8.0;
    /**
     * @var decimal
     *
     * @ORM\Column(name="maximumhoursperweek", type="decimal", precision=3, scale=1, nullable=false)
     */
    protected $maximumhoursperweek=40.0;
    /**
     * @var decimal
     *
     * @ORM\Column(name="regularrate", type="decimal", precision=10, scale=2, nullable=false)
     */
    protected $regularrate=1.00;
    /**
     * @var decimal
     *
     * @ORM\Column(name="overtimerate", type="decimal", precision=10, scale=2, nullable=false)
     */
    protected $overtimerate=1.00;
    /**
     * @var string
     *
     * @ORM\Column(name="approvername", type="string", length=255, nullable=false)
     */
    protected $approvername;
    /**
     * @var string
     *
     * @ORM\Column(name="approveremail", type="string", length=255, nullable=false)
     */
    protected $approveremail;
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    protected $description;

    /**
     * @var string
     *
     * @ORM\Column(name="uuid", type="string", nullable=false)
     */
    protected $uuid;


    public function toArray() {
        return ['id' => $this->id,
            'user' => $this->user,
            'account' => $this->account,
            'description' => $this->description,
            'project' => $this->project,
            'startdate' => $this->startdate,
            'enddate' => $this->enddate,
            'saturdayworkallowed' => $this->saturdayworkallowed,
            'sundayworkallowed' => $this->sundayworkallowed,
            'publicholidayworkallowed' => $this->publicholidayworkallowed,
            'overtimeallowed' => $this->overtimeallowed,
            'maximumhoursperday' => $this->maximumhoursperday,
            'maximumhoursperweek' => $this->maximumhoursperweek,
            'regularrate' => $this->regularrate,
            'overtimerate' => $this->overtimerate,
            'approvername' => $this->approvername,
            'approveremail' => $this->approveremail,
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
     * @return bool
     */
    public function isSaturdayworkallowed(): bool
    {
        return $this->saturdayworkallowed;
    }

    /**
     * @param bool $saturdayworkallowed
     */
    public function setSaturdayworkallowed(bool $saturdayworkallowed): void
    {
        $this->saturdayworkallowed = $saturdayworkallowed;
    }

    /**
     * @return bool
     */
    public function isSundayworkallowed(): bool
    {
        return $this->sundayworkallowed;
    }

    /**
     * @param bool $sundayworkallowed
     */
    public function setSundayworkallowed(bool $sundayworkallowed): void
    {
        $this->sundayworkallowed = $sundayworkallowed;
    }

    /**
     * @return bool
     */
    public function isPublicholidayworkallowed(): bool
    {
        return $this->publicholidayworkallowed;
    }

    /**
     * @param bool $publicholidayworkallowed
     */
    public function setPublicholidayworkallowed(bool $publicholidayworkallowed): void
    {
        $this->publicholidayworkallowed = $publicholidayworkallowed;
    }

    /**
     * @return bool
     */
    public function isOvertimeallowed(): bool
    {
        return $this->overtimeallowed;
    }

    /**
     * @param bool $overtimeallowed
     */
    public function setOvertimeallowed(bool $overtimeallowed): void
    {
        $this->overtimeallowed = $overtimeallowed;
    }

    /**
     * @return decimal
     */
    public function getMaximumhoursperday(): ?float
    {
        return $this->maximumhoursperday;
    }

    /**
     * @param decimal $maximumhoursperday
     */
    public function setMaximumhoursperday(decimal $maximumhoursperday): void
    {
        $this->maximumhoursperday = $maximumhoursperday;
    }

    /**
     * @return decimal
     */
    public function getMaximumhoursperweek(): ?float
    {
        return $this->maximumhoursperweek;
    }

    /**
     * @param decimal $maximumhoursperweek
     */
    public function setMaximumhoursperweek(decimal $maximumhoursperweek): void
    {
        $this->maximumhoursperweek = $maximumhoursperweek;
    }

    /**
     * @return decimal
     */
    public function getRegularrate(): ?float
    {
        return $this->regularrate;
    }

    /**
     * @param decimal $regularrate
     */
    public function setRegularrate(decimal $regularrate): void
    {
        $this->regularrate = $regularrate;
    }

    /**
     * @return decimal
     */
    public function getOvertimerate(): ?float
    {
        return $this->overtimerate;
    }

    /**
     * @param decimal $overtimerate
     */
    public function setOvertimerate(decimal $overtimerate): void
    {
        $this->overtimerate = $overtimerate;
    }

    /**
     * @return string
     */
    public function getApprovername(): ?string
    {
        return $this->approvername;
    }

    /**
     * @param string $approvername
     */
    public function setApprovername(string $approvername): void
    {
        $this->approvername = $approvername;
    }

    /**
     * @return string
     */
    public function getApproveremail(): ?string
    {
        return $this->approveremail;
    }

    /**
     * @param string $approveremail
     */
    public function setApproveremail(string $approveremail): void
    {
        $this->approveremail = $approveremail;
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
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }


}
