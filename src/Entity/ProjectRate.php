<?php

namespace App\Entity;

use App\Entity\User\AppUser;
use Doctrine\ORM\Mapping as ORM;

/**
 *  Project Rates
 *
 * @ORM\Table(name="projectrate")
 * @ORM\Entity(repositoryClass="App\Repository\ProjectRateRepository")
 */
class ProjectRate extends BaseEntity
{
    /**
     * @var Project
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Project")
     * @ORM\JoinColumn(name="projectid", referencedColumnName="id")
     */
    protected $project;
    /**
     * @var AppUser
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User\AppUser")
     * @ORM\JoinColumn(name="userid", referencedColumnName="id")
     */
    protected $user;
    /**
     * 
     *
     * @ORM\Column(name="clientrate", type="decimal", precision=10, scale=2, nullable=false)
     */
    protected $clientrate=1.00;
    /**
     * 
     *
     * @ORM\Column(name="contractorrate", type="decimal", precision=10, scale=2, nullable=false)
     */
    protected $contractorrate=1.00;
    /**
     * 
     *
     * @ORM\Column(name="agencyrate", type="decimal", precision=10, scale=2, nullable=false)
     */
    protected $agencyrate=1.00;
    /**
     * 
     *
     * @ORM\Column(name="overtimerate", type="decimal", precision=10, scale=2, nullable=false)
     */
    protected $overtimerate=1.00;
    /**
     * 
     *
     * @ORM\Column(name="premiumrate", type="decimal", precision=10, scale=2, nullable=false)
     */
    protected $premiumrate=1.00;
    /**
     * 
     *
     * @ORM\Column(name="doublerate", type="decimal", precision=10, scale=2, nullable=false)
     */
    protected $doublerate=1.00;
    /**
     * 
     *
     * @ORM\Column(name="triplerate", type="decimal", precision=10, scale=2, nullable=false)
     */
    protected $triplerate=1.00;
    /**
     * 
     *
     * @ORM\Column(name="dailyrate", type="decimal", precision=10, scale=2, nullable=false)
     */
    protected $dailyrate=1.00;
    /**
     * 
     *
     * @ORM\Column(name="weeklyrate", type="decimal", precision=10, scale=2, nullable=false)
     */
    protected $weeklyrate=1.00;
    /**
     * 
     *
     * @ORM\Column(name="monthlyrate", type="decimal", precision=10, scale=2, nullable=false)
     */
    protected $monthlyrate=1.00;
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
     * @ORM\Column(name="notes", type="string", nullable=true)
     */
    protected $notes;

    public function toArray() {
        return ['id' => $this->id,
            'account' => $this->account,
            'project' => $this->project,
            'user' => $this->user,
            'uuid' => $this->uuid,
            'clientrate' => $this->clientrate,
            'contractorrate' => $this->contractorrate,
            'agencyrate' => $this->agencyrate,
            'overtimerate' => $this->overtimerate,
            'premiumrate' => $this->premiumrate,
            'doublerate' => $this->doublerate,
            'triplerate' => $this->triplerate,
            'dailyrate' => $this->dailyrate,
            'weeklyrate' => $this->weeklyrate,
            'monthlyrate' => $this->monthlyrate,
            'startdate' => $this->startdate,
            'enddate' => $this->enddate,
            'notes' => $this->notes
        ];
    }

    public function toString() {
        return (string)$this->id;
    }

    public function __toString() {
        return (string) $this->id;
    }

    public function getProjectId() {
        if (empty($this->getProject())) {
            return "";
        }else {
            return $this->getProject()->getId();
        }

    }
    /**
     * @return Project
     */
    public function getProject(): ?Project
    {
        return $this->project;
    }

    /**
     * @param int $project
     */
    public function setProject(Project $project): void
    {
        $this->project = $project;
    }

    /**
     * @return AppUser
     */
    public function getUser(): ?AppUser
    {
        return $this->user;
    }

    /**
     * @param int $user
     */
    public function setUser(AppUser $user): void
    {
        $this->user = $user;
    }

    /**
     * @return decimal
     */
    public function getClientrate(): ?float
    {
        return $this->clientrate;
    }

    /**
     * @param decimal $clientrate
     */
    public function setClientrate(float $clientrate): void
    {
        $this->clientrate = $clientrate;
    }

    /**
     * @return decimal
     */
    public function getContractorrate(): ?float
    {
        return $this->contractorrate;
    }

    /**
     * @param decimal $contractorrate
     */
    public function setContractorrate(float $contractorrate): void
    {
        $this->contractorrate = $contractorrate;
    }

    /**
     * @return decimal
     */
    public function getAgencyrate(): ?float
    {
        return $this->agencyrate;
    }

    /**
     * @param decimal $agencyrate
     */
    public function setAgencyrate(float $agencyrate): void
    {
        $this->agencyrate = $agencyrate;
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
    public function setOvertimerate(float $overtimerate): void
    {
        $this->overtimerate = $overtimerate;
    }

    /**
     * @return decimal
     */
    public function getPremiumrate(): ?float
    {
        return $this->premiumrate;
    }

    /**
     * @param decimal $premiumrate
     */
    public function setPremiumrate(float $premiumrate): void
    {
        $this->premiumrate = $premiumrate;
    }

    /**
     * @return decimal
     */
    public function getDoublerate(): ?float
    {
        return $this->doublerate;
    }

    /**
     * @param decimal $doublerate
     */
    public function setDoublerate(float $doublerate): void
    {
        $this->doublerate = $doublerate;
    }

    /**
     * @return decimal
     */
    public function getTriplerate(): ?float
    {
        return $this->triplerate;
    }

    /**
     * @param decimal $triplerate
     */
    public function setTriplerate(float $triplerate): void
    {
        $this->triplerate = $triplerate;
    }

    /**
     * @return decimal
     */
    public function getDailyrate(): ?float
    {
        return $this->dailyrate;
    }

    /**
     * @param decimal $dailyrate
     */
    public function setDailyrate(float $dailyrate): void
    {
        $this->dailyrate = $dailyrate;
    }

    /**
     * @return decimal
     */
    public function getWeeklyrate(): ?float
    {
        return $this->weeklyrate;
    }

    /**
     * @param decimal $weeklyrate
     */
    public function setWeeklyrate(float $weeklyrate): void
    {
        $this->weeklyrate = $weeklyrate;
    }

    /**
     * @return decimal
     */
    public function getMonthlyrate(): ?float
    {
        return $this->monthlyrate;
    }

    /**
     * @param decimal $monthlyrate
     */
    public function setMonthlyrate(float $monthlyrate): void
    {
        $this->monthlyrate = $monthlyrate;
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
    public function setEnddate(\DateTime $enddate = null): void
    {
        $this->enddate = $enddate;
    }

    /**
     * @return string
     */
    public function getNotes(): ?string
    {
        return $this->notes;
    }

    /**
     * @param string $notes
     */
    public function setNotes(string $notes): void
    {
        $this->notes = $notes;
    }

}
