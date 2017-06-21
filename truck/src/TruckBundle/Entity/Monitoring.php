<?php

namespace TruckBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Monitoring
 *
 * @ORM\Table(name="monitoring")
 * @ORM\Entity(repositoryClass="TruckBundle\Repository\MonitoringRepository")
 */
class Monitoring
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
     * @ORM\Column(name="code", type="string", length=255)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="code_description", type="string", length=600, nullable=true)
     */
    private $codeDescription;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time_save", type="datetime")
     */
    private $timeSave;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time_set", type="datetime", nullable=true)
     */
    private $timeSet;

    /**
     * @var string
     *
     * @ORM\Column(name="document", type="string", length=600, nullable=true)
     */
    private $document;

    /**
     * @var string
     *
     * @ORM\Column(name="contact_through", type="text", nullable=true)
     */
    private $contactThrough;

    /**
     * @var string
     *
     * @ORM\Column(name="comments", type="text", nullable=true)
     */
    private $comments;

    /**
     * @var string
     *
     * @ORM\Column(name="out_comment", type="text", nullable=true)
     */
    private $outComment;

    /**
     * @var string
     *
     * @ORM\Column(name="home_dealer", type="string", length=255)
     */
    private $homeDealer;

    /**
     * @var string
     *
     * @ORM\Column(name="repair_dealer", type="string", length=255, nullable=true)
     */
    private $repairDealer;

    /**
     * @var string
     *
     * @ORM\Column(name="contact_mail", type="string", length=255, nullable=true)
     */
    private $contactMail;

    /**
     * @var string
     *
     * @ORM\Column(name="optional_mails", type="string", length=600, nullable=true)
     */
    private $optionalMails;


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
     * Set code
     *
     * @param string $code
     * @return Monitoring
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set codeDescription
     *
     * @param string $codeDescription
     * @return Monitoring
     */
    public function setCodeDescription($codeDescription)
    {
        $this->codeDescription = $codeDescription;

        return $this;
    }

    /**
     * Get codeDescription
     *
     * @return string 
     */
    public function getCodeDescription()
    {
        return $this->codeDescription;
    }

    /**
     * Set timeSave
     *
     * @param \DateTime $timeSave
     * @return Monitoring
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
     * Set timeSet
     *
     * @param \DateTime $timeSet
     * @return Monitoring
     */
    public function setTimeSet($timeSet)
    {
        $this->timeSet = $timeSet;

        return $this;
    }

    /**
     * Get timeSet
     *
     * @return \DateTime 
     */
    public function getTimeSet()
    {
        return $this->timeSet;
    }

    /**
     * Set document
     *
     * @param string $document
     * @return Monitoring
     */
    public function setDocument($document)
    {
        $this->document = $document;

        return $this;
    }

    /**
     * Get document
     *
     * @return string 
     */
    public function getDocument()
    {
        return $this->document;
    }

    /**
     * Set contactThrough
     *
     * @param string $contactThrough
     * @return Monitoring
     */
    public function setContactThrough($contactThrough)
    {
        $this->contactThrough = $contactThrough;

        return $this;
    }

    /**
     * Get contactThrough
     *
     * @return string 
     */
    public function getContactThrough()
    {
        return $this->contactThrough;
    }

    /**
     * Set comments
     *
     * @param string $comments
     * @return Monitoring
     */
    public function setComments($comments)
    {
        $this->comments = $comments;

        return $this;
    }

    /**
     * Get comments
     *
     * @return string 
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set outComment
     *
     * @param string $outComment
     * @return Monitoring
     */
    public function setOutComment($outComment)
    {
        $this->outComment = $outComment;

        return $this;
    }

    /**
     * Get outComment
     *
     * @return string 
     */
    public function getOutComment()
    {
        return $this->outComment;
    }

    /**
     * Set homeDealer
     *
     * @param string $homeDealer
     * @return Monitoring
     */
    public function setHomeDealer($homeDealer)
    {
        $this->homeDealer = $homeDealer;

        return $this;
    }

    /**
     * Get homeDealer
     *
     * @return string 
     */
    public function getHomeDealer()
    {
        return $this->homeDealer;
    }

    /**
     * Set repairDealer
     *
     * @param string $repairDealer
     * @return Monitoring
     */
    public function setRepairDealer($repairDealer)
    {
        $this->repairDealer = $repairDealer;

        return $this;
    }

    /**
     * Get repairDealer
     *
     * @return string 
     */
    public function getRepairDealer()
    {
        return $this->repairDealer;
    }

    /**
     * Set contactMail
     *
     * @param string $contactMail
     * @return Monitoring
     */
    public function setContactMail($contactMail)
    {
        $this->contactMail = $contactMail;

        return $this;
    }

    /**
     * Get contactMail
     *
     * @return string 
     */
    public function getContactMail()
    {
        return $this->contactMail;
    }

    /**
     * Set optionalMails
     *
     * @param string $optionalMails
     * @return Monitoring
     */
    public function setOptionalMails($optionalMails)
    {
        $this->optionalMails = $optionalMails;

        return $this;
    }

    /**
     * Get optionalMails
     *
     * @return string 
     */
    public function getOptionalMails()
    {
        return $this->optionalMails;
    }
}