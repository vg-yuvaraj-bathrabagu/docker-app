<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Task Queue
 *
 * @ORM\Table(name="taskqueue")
 * @ORM\Entity(repositoryClass="App\Repository\TaskQueueRepository")
 */
class TaskQueue extends Task
{
    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\TaskCategory")
     * @ORM\JoinColumn(name="categoryid", referencedColumnName="id")
     */
    protected $category;
    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", nullable=false)
     */
    protected $title;
    /**
     * @var boolean
     *
     */
    protected $istimesheettask = 2;

    public function toArray() {
        $values = parent::toArray();
        $values['category'] = $this->category;
        $values['istimesheettask'] = $this->istimesheettask;

        return $values;
    }

    /**
     * @return int
     */
    public function getCategory(): ?int
    {
        return $this->category;
    }

    /**
     * @param int $category
     */
    public function setCategory(int $category): void
    {
        $this->category = $category;
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



}
