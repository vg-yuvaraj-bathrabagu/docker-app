<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Task Category
 *
 * @ORM\Table(name="taskcategory")
 * @ORM\Entity(repositoryClass="App\Repository\TaskCategoryRepository")
 */
class TaskCategory
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
     * @var Account
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Account")
     * @ORM\JoinColumn(name="accountid", referencedColumnName="id")
     */
    protected $account;
    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", nullable=false)
     */
    protected $title;
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", nullable=true)
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
            'title' => $this->title,
            'description' => $this->description,
            'uuid' => $this->uuid
        ];
    }

    public function toString() {
        return (string)$this->id;
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
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return Account
     */
    public function getAccount(): Account
    {
        return $this->account;
    }

    /**
     * @param Account $account
     */
    public function setAccount(Account $account): void
    {
        $this->account = $account;
    }

}
