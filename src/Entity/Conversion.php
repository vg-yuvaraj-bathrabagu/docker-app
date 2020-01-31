<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Conversion
 *
 * @ORM\Table(name="conversion")
 * @ORM\Entity(repositoryClass="App\Repository\ConversionRepository")
 */
class Conversion
{
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
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=false)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=1000, nullable=false)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="parameters", type="string", length=1000, nullable=true)
     */
    private $parameters;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datecreated", type="datetime", nullable=false)
     */
    private $datecreated;
    /**
     * @var string
     *
     * @ORM\Column(name="uuid", type="string", nullable=false)
     */
    protected $uuid;
    /**
     * @var boolean
     *
     * @ORM\Column(name="isactive", type="boolean", nullable=false)
     */
    private $isactive;

    public function toArray() {
        return ['id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'type' => $this->type,
            'url' => $this->url,
            'parameters' => $this->parameters,
            'isactive' => $this->isactive,
            'uuid' => $this->uuid
        ];
    }

    public function toString() {
        return (string)$this->id;
    }

    public function __toString() {
        return $this->name;
    }

}
