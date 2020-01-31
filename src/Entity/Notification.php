<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CustomReport
 *
 * @ORM\Table(name="notification")
 * @ORM\Entity(repositoryClass="App\Repository\NotificationRepository")
 */
class Notification extends Base
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
     * @ORM\Column(name="action", type="string", length=30, nullable=false)
     */
    protected $action;
    /**
     * @var string
     *
     * @ORM\Column(name="category", type="string", length=30, nullable=false)
     */
    protected $category;

    /**
     * @var string
     *
     * @ORM\Column(name="user", type="string", length=255, nullable=true)
     */
    protected $user;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datecreated", type="datetime", nullable=false)
     */
    protected $datecreated;
    /**
     * @var integer
     *
     * @ORM\Column(name="isread", type="integer", nullable=false, options={"default":0})
     */
    protected $isread;
    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=255, nullable=true)
     */
    protected $color;

    /**
     * @return int
     */
    public function getId(): int
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
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @param string $action
     */
    public function setAction(string $action): void
    {
        $this->action = $action;
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * @param string $category
     */
    public function setCategory(string $category): void
    {
        $this->category = $category;
    }

    /**
     * @return string
     */
    public function getUser(): string
    {
        return $this->user;
    }

    /**
     * @param string $user
     */
    public function setUser(string $user): void
    {
        $this->user = $user;
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
     * @return int
     */
    public function getIsread(): int
    {
        return $this->isread;
    }

    /**
     * @param int $isread
     */
    public function setIsread(int $isread): void
    {
        $this->isread = $isread;
    }

    /**
     * @return string
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * @param string $color
     */
    public function setColor(string $color): void
    {
        $this->color = $color;
    }



    public function toArray() {
        return ['id' => $this->id,
                'action' => $this->action,
                'category' => $this->category,
                'isread' => $this->isread
        ];
    }

    public function toString() {
        return (string)$this->id;
    }


}
