<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Project
 *
 * @ORM\Table(name="project")
 * @ORM\Entity(repositoryClass="App\Repository\ProjectRepository")
 */
class Project extends BaseEntity
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
     * @var \DateTime
     *
     * @ORM\Column(name="effectivedate", type="datetime", nullable=false)
     */
    protected $effectivedate;
    /**
     * @var decimal
     *
     * @ORM\Column(name="budget", type="decimal", precision=10, scale=2, nullable=false)
     */
    protected $budget=0.00;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expirydate", type="datetime", nullable=true)
     */
    protected $expirydate;

    /**
     * @var string
     *
     * @ORM\Column(name="projectid", type="string", length=50, nullable=false)
     */
    protected $projectid;
    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=50, nullable=false)
     */
    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(name="projectcategory", type="string", length=255, nullable=true)
     */
    protected $projectcategory;
    /**
     * @var string
     *
     * @ORM\Column(name="sponsor", type="string", length=255, nullable=true)
     */
    protected $sponsor;
    /**
     * @var string
     *
     * @ORM\Column(name="projectexecutive", type="string", length=255, nullable=true)
     */
    protected $projectexecutive;
    /**
     * @var string
     *
     * @ORM\Column(name="projectmanager", type="string", length=255, nullable=true)
     */
    protected $projectmanager;
    /**
     * @var string
     *
     * @ORM\Column(name="jobcode", type="string", length=255, nullable=true)
     */
    protected $jobcode;
    /**
     * @var string
     *
     * @ORM\Column(name="costcentercode", type="string", length=255, nullable=true)
     */
    protected $costcentercode;
    /**
     * @var string
     *
     * @ORM\Column(name="activity", type="string", length=255, nullable=true)
     */
    protected $activity;
    /**
     * @var string
     *
     * @ORM\Column(name="laborpoline", type="string", length=255, nullable=true)
     */
    protected $laborpoline;
    /**
     * @var string
     *
     * @ORM\Column(name="travelpoline", type="string", length=255, nullable=true)
     */
    protected $travelpoline;
    /**
     * @var string
     *
     * @ORM\Column(name="odcpoline", type="string", length=255, nullable=true)
     */
    protected $odcpoline;
    /**
     * @var string
     *
     * @ORM\Column(name="mailinglist", type="string", length=255, nullable=true)
     */
    protected $mailinglist;
    /**
     * @var string
     *
     * @ORM\Column(name="priority", type="string", length=255, nullable=true)
     */
    protected $priority;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="estimatedstartdate", type="datetime", nullable=true)
     */
    protected $estimatedstartdate;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="estimatedenddate", type="datetime", nullable=true)
     */
    protected $estimatedenddate;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="actualstartdate", type="datetime", nullable=true)
     */
    protected $actualstartdate;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="actualenddate", type="datetime", nullable=true)
     */
    protected $actualenddate;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255, nullable=true)
     */
    protected $status;

    /**
     * @var string
     *
     * @ORM\Column(name="immediatesupervisorname", type="string", length=200, nullable=true)
     */
    protected $immediatesupervisorname;
    /**
     * @var string
     *
     * @ORM\Column(name="immediatesupervisorphone", type="string", length=200, nullable=true)
     */
    protected $immediatesupervisorphone;
    /**
     * @var string
     *
     * @ORM\Column(name="immediatesupervisoremail", type="string", length=200, nullable=true)
     */
    protected $immediatesupervisoremail;
    /**
     * @var string
     *
     * @ORM\Column(name="supervisorname", type="string", length=200, nullable=true)
     */
    protected $supervisorname;
    /**
     * @var string
     *
     * @ORM\Column(name="supervisorphone", type="string", length=200, nullable=true)
     */
    protected $supervisorphone;
    /**
     * @var string
     *
     * @ORM\Column(name="supervisoremail", type="string", length=200, nullable=true)
     */
    protected $supervisoremail;

    /**
     * @var string
     *
     * @ORM\Column(name="notes", type="text", length=16777215, nullable=true)
     */
    protected $notes;
    /**
     * @var integer
     *
     * @ORM\Column(name="createdby", type="bigint", nullable=false)
     */
    protected $createdby;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datecreated", type="datetime", nullable=true)
     */
    protected $datecreated;
    /**
     * @var integer
     *
     * @ORM\Column(name="lastupdatedby", type="bigint", nullable=true)
     */
    protected $lastupdatedby;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="lastupdatedate", type="datetime", nullable=true)
     */
    protected $lastupdatedate;
    /**
     * @var string
     *
     * @ORM\Column(name="ponumber", type="string", length=10, nullable=true)
     */
    protected $ponumber;
    /**
     * @var string
     *
     * @ORM\Column(name="taskcode", type="string", length=10, nullable=true)
     */
    protected $taskcode;
    /**
     * @var boolean
     *
     * @ORM\Column(name="currentflag", type="boolean", nullable=false)
     */
    protected $currentflag;
    /**
     * @var integer
     *
     * @ORM\Column(name="companyid", type="bigint", nullable=true)
     */
    protected $companyid;
    /**
     * @var string
     *
     * @ORM\Column(name="uuid", type="string", nullable=false)
     */
    protected $uuid;
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
     * @ORM\Column(name="type", type="string", length=255, nullable=false)
     */
    protected $type = "Waterfall";
    /**
     * @var integer
     *
     * @ORM\Column(name="sprintcount", type="integer", nullable=true)
     */
    protected $sprintcount = 0;
    /**
     * @var integer
     *
     * @ORM\Column(name="sprintduration", type="integer", nullable=true)
     */
    protected $sprintduration = 0;
    /**
     * @var int
     *
     * @ORM\Column(name="builtin", type="integer", nullable=true)
     */
    protected $builtin = 0;

    public function toArray() {
        return ['id' => $this->id,
            'effectivedate' => $this->effectivedate,
            'expirydate' => $this->expirydate,
            'projectid' => $this->projectid,
            'title' => $this->title,
            'budget' => $this->budget,
            'projectcategory' => $this->projectcategory,
            'sponsor' => $this->sponsor,
            'uuid' => $this->uuid,
            'projectexecutive' => $this->projectexecutive,
            'projectmanager' => $this->projectmanager,
            'jobcode' => $this->jobcode,
            'costcentercode' => $this->costcentercode,
            'activity' => $this->activity,
            'laborpoline' => $this->laborpoline,
            'travelpoline' => $this->travelpoline,
            'odcpoline' => $this->odcpoline,
            'mailinglist' => $this->mailinglist,
            'estimatedstartdate' => $this->estimatedstartdate,
            'estimatedenddate' => $this->estimatedenddate,
            'actualstartdate' => $this->actualstartdate,
            'actualenddate' => $this->actualenddate,
            'status' => $this->status,
            'immediatesupervisorname' => $this->immediatesupervisorname,
            'immediatesupervisorphone' => $this->immediatesupervisorphone,
            'immediatesupervisoremail' => $this->immediatesupervisoremail,
            'supervisorname' => $this->supervisorname,
            'supervisorphone' => $this->supervisorphone,
            'supervisoremail' => $this->supervisoremail,
            'notes' => $this->notes,
            'datecreated' => $this->datecreated,
            'lastupdatedby' => $this->lastupdatedby,
            'lastupdatedate' => $this->lastupdatedate,
            'ponumber' => $this->ponumber,
            'taskcode' => $this->taskcode,
            'currentflag' => $this->currentflag,
            'companyid' => $this->companyid,
            'type' => $this->type,
            'sprintcount' => $this->sprintcount,
            'sprintduration' => $this->sprintduration,
            'builtin' => $this->builtin
        ];
    }

    public function toString() {
        return (string)$this->id;
    }

    public function __toString() {
        return $this->title;
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
    public function getEffectivedate(): ?\DateTime
    {
        return $this->effectivedate;
    }

    /**
     * @param \DateTime $effectivedate
     */
    public function setEffectivedate(\DateTime $effectivedate = null): void
    {
        $this->effectivedate = $effectivedate;
    }

    /**
     * @return decimal
     */
    public function getBudget(): ?float
    {
        return $this->budget;
    }

    /**
     * @param decimal $budget
     */
    public function setBudget(float $budget): void
    {
        $this->budget = $budget;
    }

    /**
     * @return \DateTime
     */
    public function getExpirydate(): ?\DateTime
    {
        return $this->expirydate;
    }

    /**
     * @param \DateTime $expirydate
     */
    public function setExpirydate(\DateTime $expirydate = null): void
    {
        $this->expirydate = $expirydate;
    }

    /**
     * @return string
     */
    public function getProjectid(): ?string
    {
        return $this->projectid;
    }

    /**
     * @param string $projectid
     */
    public function setProjectid(string $projectid): void
    {
        $this->projectid = $projectid;
    }

    /**
     * @return string
     */
    public function getProjectcategory(): ?string
    {
        return $this->projectcategory;
    }

    /**
     * @param string $projectcategory
     */
    public function setProjectcategory(string $projectcategory): void
    {
        $this->projectcategory = $projectcategory;
    }

    /**
     * @return string
     */
    public function getSponsor(): ?string
    {
        return $this->sponsor;
    }

    /**
     * @param string $sponsor
     */
    public function setSponsor(string $sponsor): void
    {
        $this->sponsor = $sponsor;
    }

    /**
     * @return string
     */
    public function getProjectexecutive(): ?string
    {
        return $this->projectexecutive;
    }

    /**
     * @param string $projectexecutive
     */
    public function setProjectexecutive(string $projectexecutive): void
    {
        $this->projectexecutive = $projectexecutive;
    }

    /**
     * @return string
     */
    public function getProjectmanager(): ?string
    {
        return $this->projectmanager;
    }

    /**
     * @param string $projectmanager
     */
    public function setProjectmanager(string $projectmanager): void
    {
        $this->projectmanager = $projectmanager;
    }

    /**
     * @return string
     */
    public function getJobcode(): ?string
    {
        return $this->jobcode;
    }

    /**
     * @param string $jobcode
     */
    public function setJobcode(string $jobcode): void
    {
        $this->jobcode = $jobcode;
    }

    /**
     * @return string
     */
    public function getCostcentercode(): ?string
    {
        return $this->costcentercode;
    }

    /**
     * @param string $costcentercode
     */
    public function setCostcentercode(string $costcentercode): void
    {
        $this->costcentercode = $costcentercode;
    }

    /**
     * @return string
     */
    public function getActivity(): ?string
    {
        return $this->activity;
    }

    /**
     * @param string $activity
     */
    public function setActivity(string $activity): void
    {
        $this->activity = $activity;
    }

    /**
     * @return string
     */
    public function getLaborpoline(): ?string
    {
        return $this->laborpoline;
    }

    /**
     * @param string $laborpoline
     */
    public function setLaborpoline(string $laborpoline): void
    {
        $this->laborpoline = $laborpoline;
    }

    /**
     * @return string
     */
    public function getTravelpoline(): ?string
    {
        return $this->travelpoline;
    }

    /**
     * @param string $travelpoline
     */
    public function setTravelpoline(string $travelpoline): void
    {
        $this->travelpoline = $travelpoline;
    }

    /**
     * @return string
     */
    public function getOdcpoline(): ?string
    {
        return $this->odcpoline;
    }

    /**
     * @param string $odcpoline
     */
    public function setOdcpoline(string $odcpoline): void
    {
        $this->odcpoline = $odcpoline;
    }

    /**
     * @return string
     */
    public function getMailinglist(): ?string
    {
        return $this->mailinglist;
    }

    /**
     * @param string $mailinglist
     */
    public function setMailinglist(string $mailinglist): void
    {
        $this->mailinglist = $mailinglist;
    }

    /**
     * @return string
     */
    public function getPriority(): ?string
    {
        return $this->priority;
    }

    /**
     * @param string $priority
     */
    public function setPriority(string $priority): void
    {
        $this->priority = $priority;
    }

    /**
     * @return \DateTime
     */
    public function getEstimatedstartdate(): ?\DateTime
    {
        return $this->estimatedstartdate;
    }

    /**
     * @param \DateTime $estimatedstartdate
     */
    public function setEstimatedstartdate(\DateTime $estimatedstartdate = null): void
    {
        $this->estimatedstartdate = $estimatedstartdate;
    }

    /**
     * @return \DateTime
     */
    public function getEstimatedenddate(): ?\DateTime
    {
        return $this->estimatedenddate;
    }

    /**
     * @param \DateTime $estimatedenddate
     */
    public function setEstimatedenddate(\DateTime $estimatedenddate = null): void
    {
        $this->estimatedenddate = $estimatedenddate;
    }

    /**
     * @return \DateTime
     */
    public function getActualstartdate(): ?\DateTime
    {
        return $this->actualstartdate;
    }

    /**
     * @param \DateTime $actualstartdate
     */
    public function setActualstartdate(\DateTime $actualstartdate = null): void
    {
        $this->actualstartdate = $actualstartdate;
    }

    /**
     * @return \DateTime
     */
    public function getActualenddate(): ?\DateTime
    {
        return $this->actualenddate;
    }

    /**
     * @param \DateTime $actualenddate
     */
    public function setActualenddate(\DateTime $actualenddate = null): void
    {
        $this->actualenddate = $actualenddate;
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
    public function getImmediatesupervisorname(): ?string
    {
        return $this->immediatesupervisorname;
    }

    /**
     * @param string $immediatesupervisorname
     */
    public function setImmediatesupervisorname(string $immediatesupervisorname): void
    {
        $this->immediatesupervisorname = $immediatesupervisorname;
    }

    /**
     * @return string
     */
    public function getImmediatesupervisorphone(): ?string
    {
        return $this->immediatesupervisorphone;
    }

    /**
     * @param string $immediatesupervisorphone
     */
    public function setImmediatesupervisorphone(string $immediatesupervisorphone): void
    {
        $this->immediatesupervisorphone = $immediatesupervisorphone;
    }

    /**
     * @return string
     */
    public function getImmediatesupervisoremail(): ?string
    {
        return $this->immediatesupervisoremail;
    }

    /**
     * @param string $immediatesupervisoremail
     */
    public function setImmediatesupervisoremail(string $immediatesupervisoremail): void
    {
        $this->immediatesupervisoremail = $immediatesupervisoremail;
    }

    /**
     * @return string
     */
    public function getSupervisorname(): ?string
    {
        return $this->supervisorname;
    }

    /**
     * @param string $supervisorname
     */
    public function setSupervisorname(string $supervisorname): void
    {
        $this->supervisorname = $supervisorname;
    }

    /**
     * @return string
     */
    public function getSupervisorphone(): ?string
    {
        return $this->supervisorphone;
    }

    /**
     * @param string $supervisorphone
     */
    public function setSupervisorphone(string $supervisorphone): void
    {
        $this->supervisorphone = $supervisorphone;
    }

    /**
     * @return string
     */
    public function getSupervisoremail(): ?string
    {
        return $this->supervisoremail;
    }

    /**
     * @param string $supervisoremail
     */
    public function setSupervisoremail(string $supervisoremail): void
    {
        $this->supervisoremail = $supervisoremail;
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

    /**
     * @return int
     */
    public function getCreatedby(): ?int
    {
        return $this->createdby;
    }

    /**
     * @param int $createdby
     */
    public function setCreatedby(int $createdby): void
    {
        $this->createdby = $createdby;
    }

    /**
     * @return \DateTime
     */
    public function getDatecreated(): ?\DateTime
    {
        return $this->datecreated;
    }

    /**
     * @param \DateTime $datecreated
     */
    public function setDatecreated(\DateTime $datecreated = null): void
    {
        $this->datecreated = $datecreated;
    }

    /**
     * @return int
     */
    public function getLastupdatedby(): ?int
    {
        return $this->lastupdatedby;
    }

    /**
     * @param int $lastupdatedby
     */
    public function setLastupdatedby(int $lastupdatedby): void
    {
        $this->lastupdatedby = $lastupdatedby;
    }

    /**
     * @return \DateTime
     */
    public function getLastupdatedate(): ?\DateTime
    {
        return $this->lastupdatedate;
    }

    /**
     * @param \DateTime $lastupdatedate
     */
    public function setLastupdatedate(\DateTime $lastupdatedate = null): void
    {
        $this->lastupdatedate = $lastupdatedate;
    }

    /**
     * @return string
     */
    public function getPonumber(): ?string
    {
        return $this->ponumber;
    }

    /**
     * @param string $ponumber
     */
    public function setPonumber(string $ponumber): void
    {
        $this->ponumber = $ponumber;
    }

    /**
     * @return string
     */
    public function getTaskcode(): ?string
    {
        return $this->taskcode;
    }

    /**
     * @param string $taskcode
     */
    public function setTaskcode(string $taskcode): void
    {
        $this->taskcode = $taskcode;
    }

    /**
     * @return bool
     */
    public function isCurrentflag(): ?bool
    {
        return $this->currentflag;
    }

    /**
     * @param bool $currentflag
     */
    public function setCurrentflag(bool $currentflag): void
    {
        $this->currentflag = $currentflag;
    }

    /**
     * @return int
     */
    public function getCompanyid(): ?int
    {
        return $this->companyid;
    }

    /**
     * @param int $companyid
     */
    public function setCompanyid(int $companyid): void
    {
        $this->companyid = $companyid;
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
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return int
     */
    public function getSprintcount(): ?int
    {
        return $this->sprintcount;
    }

    /**
     * @param int $sprintcount
     */
    public function setSprintcount(int $sprintcount = null): void
    {
        $this->sprintcount = $sprintcount;
    }

    /**
     * @return int
     */
    public function getSprintduration(): ?int
    {
        return $this->sprintduration;
    }

    /**
     * @param int $sprintduration
     */
    public function setSprintduration(int $sprintduration = null): void
    {
        $this->sprintduration = $sprintduration;
    }

    /**
     * @return int
     */
    public function getBuiltin(): ?int
    {
        return $this->builtin;
    }

    /**
     * @param int $builtin
     */
    public function setBuiltin(int $builtin): void
    {
        $this->builtin = $builtin;
    }


}
