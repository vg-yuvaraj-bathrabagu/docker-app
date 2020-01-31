<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Timesheet detail for hours worked per day
 *
 * @ORM\Table(name="timesheet_detail")
 * @ORM\Entity(repositoryClass="App\Repository\TimesheetDetailRepository")
 */
class TimesheetDetail
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
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Project")
     * @ORM\JoinColumn(name="projectid", referencedColumnName="id")
     */
    protected $project;
    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Timesheet")
     * @ORM\JoinColumn(name="timesheetid", referencedColumnName="id")
     */
    protected $timesheet;
    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\ProjectAssignment")
     * @ORM\JoinColumn(name="projectassignmentid", referencedColumnName="id")
     */
    protected $projectassignment;
    /**
     * @var \Date
     *
     * @ORM\Column(name="workday", type="date", nullable=false)
     */
    protected $workday;
    /**
     * @var decimal
     *
     * @ORM\Column(name="hours", type="decimal", precision=2, scale=1, nullable=false)
     */
    protected $hours = 0.0;
    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Task")
     * @ORM\JoinColumn(name="taskid", referencedColumnName="id")
     */
    protected $task;

    public function toArray() {
        return ['id' => $this->id,
            'user' => $this->user,
            'account' => $this->account,
            'timesheet' => $this->timesheet,
            'project' => $this->project,
            'projectassignment' => $this->projectassignment,
            'workday' => $this->workday,
            'hours' => $this->hours,
            'task' => $this->task
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
    public function getTimesheet(): ?int
    {
        return $this->timesheet;
    }

    /**
     * @param int $timesheet
     */
    public function setTimesheet(int $timesheet): void
    {
        $this->timesheet = $timesheet;
    }

    /**
     * @return int
     */
    public function getProjectassignment(): ?int
    {
        return $this->projectassignment;
    }

    /**
     * @param int $projectassignment
     */
    public function setProjectassignment(int $projectassignment): void
    {
        $this->projectassignment = $projectassignment;
    }

    /**
     * @return \Date
     */
    public function getWorkday(): ?\Date
    {
        return $this->workday;
    }

    /**
     * @param \Date $workday
     */
    public function setWorkday(\Date $workday): void
    {
        $this->workday = $workday;
    }

    /**
     * @return decimal
     */
    public function getHours(): ?decimal
    {
        return $this->hours;
    }

    /**
     * @param decimal $hours
     */
    public function setHours(decimal $hours): void
    {
        $this->hours = $hours;
    }


}
