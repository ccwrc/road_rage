<?php

namespace TruckBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;
use \DateTime;

/**
 * Note
 *
 * @ORM\Table(name="note")
 * @ORM\Entity(repositoryClass="TruckBundle\Repository\NoteRepository")
 */
class Note
{

    public function __construct()
    {
        $this->timeSave = new DateTime("now");
    }

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @Assert\Choice({"private", "public"})
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=60)
     */
    private $status;

    /**
     * @Assert\Type(type="integer")
     * @var int
     *
     * @ORM\Column(name="user_id", type="integer")
     */
    private $userId;

    /**
     * @Assert\Type("string")
     * @Assert\Length(
     * min = 1,
     * max = 255
     * )
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255)
     */
    private $username;

    /**
     * @Assert\DateTime()
     * @var \DateTime
     *
     * @ORM\Column(name="time_save", type="datetime")
     */
    private $timeSave;

    /**
     * @Assert\DateTime()
     * @var \DateTime
     *
     * @ORM\Column(name="time_publication", type="datetime")
     */
    private $timePublication;

    /**
     * @Assert\Type("string")
     * @Assert\Length(
     * min = 1,
     * max = 21000,
     * minMessage = "Minimum number of characters is {{ limit }}",
     * maxMessage = "Maximum number of characters is {{ limit }}"
     * )
     * @var string
     *
     * @ORM\Column(name="content", type="string", length=21000)
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


    /**
     * Set username
     *
     * @param string $username
     * @return Note
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }
}
