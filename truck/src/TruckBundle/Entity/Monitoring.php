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
     * @ORM\ManyToOne(targetEntity="AccidentCase", inversedBy="monitorings")
     * @ORM\JoinColumn(name="accident_case_id", referencedColumnName="id")
     */
    private $accidentCase;
    
    /**
     * @ORM\ManyToOne(targetEntity="Dealer")
     */
    private $homeDealer;
    
    /**
     * @ORM\ManyToOne(targetEntity="Dealer")
     */
    private $repairDealer;    

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
     * @ORM\Column(name="operator", type="string", length=600, nullable=true)
     */
    private $operator;

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
     * @var int
     *
     * @ORM\Column(name="amount", type="integer", nullable=true)
     */
    private $amount;   
    
    /**
     * @var string
     *
     * @ORM\Column(name="currency", type="string", length=100, nullable=true)
     */
    private $currency;    


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

    /**
     * Set accidentCase
     *
     * @param \TruckBundle\Entity\AccidentCase $accidentCase
     * @return Monitoring
     */
    public function setAccidentCase(\TruckBundle\Entity\AccidentCase $accidentCase = null)
    {
        $this->accidentCase = $accidentCase;

        return $this;
    }

    /**
     * Get accidentCase
     *
     * @return \TruckBundle\Entity\AccidentCase 
     */
    public function getAccidentCase()
    {
        return $this->accidentCase;
    }

    /**
     * Set operator
     *
     * @param string $operator
     * @return Monitoring
     */
    public function setOperator($operator)
    {
        $this->operator = $operator;

        return $this;
    }

    /**
     * Get operator
     *
     * @return string 
     */
    public function getOperator()
    {
        return $this->operator;
    }

    /**
     * Set homeDealer
     *
     * @param \TruckBundle\Entity\Dealer $homeDealer
     * @return Monitoring
     */
    public function setHomeDealer(\TruckBundle\Entity\Dealer $homeDealer = null)
    {
        $this->homeDealer = $homeDealer;

        return $this;
    }

    /**
     * Get homeDealer
     *
     * @return \TruckBundle\Entity\Dealer 
     */
    public function getHomeDealer()
    {
        return $this->homeDealer;
    }

    /**
     * Set repairDealer
     *
     * @param \TruckBundle\Entity\Dealer $repairDealer
     * @return Monitoring
     */
    public function setRepairDealer(\TruckBundle\Entity\Dealer $repairDealer = null)
    {
        $this->repairDealer = $repairDealer;

        return $this;
    }

    /**
     * Get repairDealer
     *
     * @return \TruckBundle\Entity\Dealer 
     */
    public function getRepairDealer()
    {
        return $this->repairDealer;
    }

    /**
     * Set amount
     *
     * @param integer $amount
     * @return Monitoring
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return integer 
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set currency
     *
     * @param string $currency
     * @return Monitoring
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get currency
     *
     * @return string 
     */
    public function getCurrency()
    {
        return $this->currency;
    }
}
