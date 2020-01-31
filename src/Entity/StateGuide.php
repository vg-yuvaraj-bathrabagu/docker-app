<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Project
 *
 * @ORM\Table(name="state_guide")
 * @ORM\Entity(repositoryClass="App\Repository\StateGuideRepository")
 */
class StateGuide extends BaseEntity
{
    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string", nullable=false)
     */
    protected $state;
    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", nullable=false)
     */
    protected $code;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="effectivedate", type="datetime", nullable=false)
     */
    protected $effectivedate;
    /**
     * @var decimal
     *
     * @ORM\Column(name="salesdollarsthreshold", type="decimal", precision=10, scale=2, nullable=false)
     */
    protected $salesdollarsthreshold;
    /**
     * @var integer
     *
     * @ORM\Column(name="salestransactionsthreshold", type="bigint", nullable=false)
     */
    protected $salestransactionsthreshold;
    /**
     * @var decimal
     *
     * @ORM\Column(name="nearingsalesthreshold", type="decimal", precision=10, scale=2, nullable=false)
     */
    protected $nearingsalesthreshold;
    /**
     * @var integer
     *
     * @ORM\Column(name="nearingtransactioncountthreshold", type="bigint", nullable=false)
     */
    protected $nearingtransactioncountthreshold;

    public function toArray() {
        return ['id' => $this->id,
            'state' => $this->state,
            'code' => $this->code,
            'effectivedate' => $this->effectivedate,
            'salesdollarsthreshold' => $this->salesdollarsthreshold,
            'salestransactionsthreshold' => $this->salestransactionsthreshold,
            'nearingsalesthreshold' => $this->nearingsalesthreshold,
            'nearingtransactioncountthreshold' => $this->nearingtransactioncountthreshold,
        ];
    }

    public function toString() {
        return (string)$this->state;
    }

    public function __toString() {
        return $this->state;
    }

    /**
     * @return string
     */
    public function getState(): ?string
    {
        return $this->state;
    }

    /**
     * @return string
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @return \DateTime
     */
    public function getEffectivedate(): ?\DateTime
    {
        return $this->effectivedate;
    }

    /**
     * @return decimal
     */
    public function getSalesdollarsthreshold(): ?float
    {
        return $this->salesdollarsthreshold;
    }

    /**
     * @return int
     */
    public function getSalestransactionsthreshold(): ?int
    {
        return $this->salestransactionsthreshold;
    }

    /**
     * @return decimal
     */
    public function getNearingsalesthreshold(): ?float
    {
        return $this->nearingsalesthreshold;
    }

    /**
     * @return int
     */
    public function getNearingtransactioncountthreshold(): ?int
    {
        return $this->nearingtransactioncountthreshold;
    }



}
