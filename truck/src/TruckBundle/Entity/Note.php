<?php

namespace TruckBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Note
 *
 * @ORM\Table(name="note")
 * @ORM\Entity(repositoryClass="TruckBundle\Repository\NoteRepository")
 */
class Note
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=60)
     */
    private $status;

    /**
     * @var int
     *
     * @ORM\Column(name="userId", type="integer")
     */
    private $userId;

    /**
     * @var string
     *
     * @ORM\Column(name="usernameAndRole", type="string", length=255)
     */
    private $usernameAndRole;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="timeSave", type="datetime")
     */
    private $timeSave;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="timePublication", type="datetime")
     */
    private $timePublication;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="string", length=22000)
     */
    private $content;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Note
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     * @return Note
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set usernameAndRole
     *
     * @param string $usernameAndRole
     * @return Note
     */
    public function setUsernameAndRole($usernameAndRole)
    {
        $this->usernameAndRole = $usernameAndRole;

        return $this;
    }

    /**
     * Get usernameAndRole
     *
     * @return string 
     */
    public function getUsernameAndRole()
    {
        return $this->usernameAndRole;
    }

    /**
     * Set timeSave
     *
     * @param \DateTime $timeSave
     * @return Note
     */
    public function setTimeSave($timeSave)
    {
        $this->timeSave = $timeSave;

        return $this;
    }

    /**
     * Get timeSave
     *
     * @return \DateTime 
     */
    public function getTimeSave()
    {
        return $this->timeSave;
    }

    /**
     * Set timePublication
     *
     * @param \DateTime $timePublication
     * @return Note
     */
    public function setTimePublication($timePublication)
    {
        $this->timePublication = $timePublication;

        return $this;
    }

    /**
     * Get timePublication
     *
     * @return \DateTime 
     */
    public function getTimePublication()
    {
        return $this->timePublication;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Note
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }
}
