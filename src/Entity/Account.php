<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Account
 *
 * @ORM\Table(name="account", uniqueConstraints={@ORM\UniqueConstraint(name="account_name", columns={"name"})})
 * @ORM\Entity(repositoryClass="App\Repository\AccountRepository")
 */
class Account
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
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    protected $name;
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datecreated", type="datetime", nullable=false)
     */
    protected $datecreated;
    /**
     * @var string
     *
     * @ORM\Column(name="uuid", type="string", nullable=false)
     */
    protected $uuid;
    /**
     * @var string
     *
     * @ORM\Column(name="dashboard_url", type="string", nullable=false)
     */
    protected $dashboardurl;
    /**
     * @var string
     *
     * @ORM\Column(name="current_activity_url", type="string", nullable=false)
     */
    protected $currentactivityurl;
    /**
     * @var string
     *
     * @ORM\Column(name="history_activity_url", type="string", nullable=false)
     */
    protected $historyactivityurl;
    /**
     * @var string
     *
     * @ORM\Column(name="nexus_report_url", type="string", nullable=false)
     */
    protected $nexusreporturl;
    /**
     * @var string
     *
     * @ORM\Column(name="snstopic", type="string", nullable=false)
     */
    protected $snstopic;

    public function toArray() {
        return ['id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'datecreated' => $this->datecreated,
            'uuid' => $this->uuid,
            'currentactivityurl' => $this->currentactivityurl,
            'dashboardurl' => $this->dashboardurl,
            'historyactivityurl' => $this->historyactivityurl,
            'nexusreporturl' => $this->nexusreporturl,
            'snstopic' => $this->snstopic
        ];
    }

    public function toString(): string {
        return $this->name;
    }

    public function __toString()
    {
        return $this->name;
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
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return \DateTime
     */
    public function getDatecreated(): \DateTime
    {
        return $this->datecreated;
    }

    /**
     * @param \DateTime $datecreated
     */
    public function setDatecreated(\DateTime $datecreated): void
    {
        $this->datecreated = $datecreated;
    }

    /**
     * @return string
     */
    public function getUuid(): string
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
    public function getDescription(): string
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

    /**
     * @return string
     */
    public function getDashboardurl(): string
    {
        return $this->dashboardurl;
    }

    /**
     * @param string $dashboardurl
     */
    public function setDashboardurl(string $dashboardurl): void
    {
        $this->dashboardurl = $dashboardurl;
    }

    /**
     * @return string
     */
    public function getCurrentactivityurl(): string
    {
        return $this->currentactivityurl;
    }

    /**
     * @param string $currentactivityurl
     */
    public function setCurrentactivityurl(string $currentactivityurl): void
    {
        $this->currentactivityurl = $currentactivityurl;
    }

    /**
     * @return string
     */
    public function getHistoryactivityurl(): string
    {
        return $this->historyactivityurl;
    }

    /**
     * @param string $historyactivityurl
     */
    public function setHistoryactivityurl(string $historyactivityurl): void
    {
        $this->historyactivityurl = $historyactivityurl;
    }


    /**
     * @return string
     */
    public function getSNSTopic(): string
    {
        return $this->snstopic;
    }

    /**
     * @return string
     */
    public function getNexusreporturl(): string
    {
        return $this->nexusreporturl;
    }

    /**
     * @param string $nexusreporturl
     */
    public function setNexusreporturl(string $nexusreporturl): void
    {
        $this->nexusreporturl = $nexusreporturl;
    }



}