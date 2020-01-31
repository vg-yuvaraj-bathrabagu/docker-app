<?php

namespace App\Entity;

use App\Helper\Utils;
use Doctrine\ORM\Mapping as ORM;

/**
 * Account
 *
 * @ORM\Table(name="template", uniqueConstraints={@ORM\UniqueConstraint(name="unique_template_name", columns={"name"})})
 * @ORM\Entity(repositoryClass="App\Repository\TemplateRepository")
 */
class Template
{
    use Utils;
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
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;
    /**
     * @var string
     *
     * @ORM\Column(name="format", type="string", length=25, nullable=false)
     */
    private $format;
    /**
     * @var string
     *
     * @ORM\Column(name="tablename", type="string", length=255, nullable=false)
     */
    private $tablename;
    /**
     * @var string
     *
     * @ORM\Column(name="rules", type="text", length=16777215, nullable=true)
     */
    private $rules;
    /**
     * @var string
     *
     * @ORM\Column(name="samplerow", type="text", length=16777215, nullable=true)
     */
    private $samplerow;
    /**
     * @var int
     *
     * @ORM\Column(name="creationtype", type="integer", nullable=true)
     */
    private $creationtype;
    /**
     * @var string
     *
     * @ORM\Column(name="delimiter", type="string", length=25, nullable=true)
     */
    private $delimiter = ",";
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datecreated", type="datetime", nullable=false)
     */
    private $datecreated;
    /**
     * @var string
     *
     * @ORM\Column(name="uuid", type="string", length=38, nullable=true)
     */
    private $uuid;
    /**
     * @var boolean
     *
     * @ORM\Column(name="isactive", type="boolean", nullable=false)
     */
    private $isactive;
    /**
     * @var boolean
     *
     * @ORM\Column(name="forsync", type="boolean", nullable=false)
     */
    private $forsync;
    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", nullable=false)
     */
    protected $color;
    /**
     * @var string
     *
     * @ORM\Column(name="bucketinput", type="string", length=255, nullable=false)
     */
    private $bucketinput;
    /**
     * @var string
     *
     * @ORM\Column(name="bucketoutput", type="string", length=255, nullable=false)
     */
    private $bucketoutput;
    /**
     * @var integer
     *
     * @ORM\Column(name="filecount", type="integer", nullable=false)
     */
    private $filecount;
    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=10, nullable=false)
     */
    private $type = 'User';
    /**
     * @var integer
     *
     * @ORM\Column(name="createdby", type="bigint", nullable=false)
     */
    protected $createdby;
    /**
     * @var integer
     *
     * @ORM\Column(name="simulationid", type="integer", nullable=true)
     */
    protected $simulationid;

    /** TODO: Find an option to remove these fields that are required to required to generate a form field  */
    private $processing;
    private $datatype;
    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Account")
     * @ORM\JoinColumn(name="accountid", referencedColumnName="id")
     */
    protected $account;
    /**
     * @return mixed
     */
    public function getProcessing()
    {
        return $this->processing;
    }

    /**
     * @param mixed $processing
     */
    public function setProcessing($processing): void
    {
        $this->processing = $processing;
    }

    /**
     * @return mixed
     */
    public function getDatatype()
    {
        return $this->datatype;
    }

    /**
     * @param mixed $datatype
     */
    public function setDatatype($datatype): void
    {
        $this->datatype = $datatype;
    }



    /**
     * @return string
     */
    public function getTablename(): ?string
    {
        return $this->tablename;
    }

    /**
     * @param string $tablename
     */
    public function setTablename(string $tablename): void
    {
        $this->tablename = $tablename;
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
     * @return string
     */
    public function getFormat(): ?string
    {
        return $this->format;
    }

    /**
     * @param string $format
     */
    public function setFormat(string $format): void
    {
        $this->format = $format;
    }

    /**
     * @return string
     */
    public function getRules(): ?string
    {
        return $this->rules;
    }

    /**
     * @param string $rules
     */
    public function setRules(string $rules): void
    {
        $this->rules = $rules;
    }

    /**
     * @return string
     */
    public function getSamplerow(): ?string
    {
        return $this->samplerow;
    }

    /**
     * @param string $samplerow
     */
    public function setSamplerow(string $samplerow): void
    {
        $this->samplerow = $samplerow;
    }

    /**
     * @return int
     */
    public function getCreationtype(): ?int
    {
        return $this->creationtype;
    }

    /**
     * @param int $creationtype
     */
    public function setCreationtype(int $creationtype): void
    {
        $this->creationtype = $creationtype;
    }

    /**
     * @return string
     */
    public function getDelimiter(): ?string
    {
        return $this->delimiter;
    }

    /**
     * @return string
     */
    public function getDelimiterCharacter(): ?string
    {
        if (is_null($this->delimiter)) {
            return $this->delimiter;
        }

        if ($this->delimiter == "Tab") {
            return "\t";
        }
        return ",";
    }

    /**
     * @param string $delimiter
     */
    public function setDelimiter(string $delimiter): void
    {
        $this->delimiter = $delimiter;
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
    public function setDatecreated(\DateTime $datecreated): void
    {
        $this->datecreated = $datecreated;
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
     * @return bool
     */
    public function isIsactive(): ?bool
    {
        return $this->isactive;
    }

    /**
     * @param bool $isactive
     */
    public function setIsactive(bool $isactive): void
    {
        $this->isactive = $isactive;
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


    public function toArray() {
        return ['id' => $this->id,
            'name' => $this->name,
            'tablename' => $this->tablename,
            'format' => $this->format,
            'samplerow' => $this->samplerow,
            'delimiter' => $this->delimiter,
            'rules' => $this->transformJSONToTemplateFieldValues($this->rules),
            'isactive' => $this->isactive,
            'forsync' => $this->forsync,
            'color' => $this->color,
            'bucketinput' => $this->bucketinput,
            'bucketoutput' => $this->bucketoutput,
            'filecount' => $this->filecount,
            'uuid' => $this->uuid,
            'type' => $this->type,
            'createdby' => $this->createdby,
            'uuid' => $this->uuid,
            'simulationid' => $this->simulationid,
        ];
    }

    public function toString() {
        return json_encode($this->toArray());
    }

    public function __toString() {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getSimulationid(): ?int
    {
        return $this->simulationid;
    }

    /**
     * @param int $simulationid
     */
    public function setSimulationid(int $simulationid): void
    {
        $this->simulationid = $simulationid;
    }



}