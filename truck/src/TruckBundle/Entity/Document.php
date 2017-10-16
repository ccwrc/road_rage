<?php

namespace TruckBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Document
 *
 * @ORM\Table(name="document")
 * @ORM\Entity(repositoryClass="TruckBundle\Repository\DocumentRepository")
 */
class Document {
    
    public function __construct() {
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
     * @var string
     *
     * @ORM\Column(name="operator", type="string", length=600)
     */
    private $operator;

    /**
     * @var string
     *
     * @ORM\Column(name="monitoring", type="string", length=255)
     */
    private $monitoring;

    /**
     * @var string
     *
     * @ORM\Column(name="homeDealer", type="string", length=255)
     */
    private $homeDealer;

    /**
     * @var string
     *
     * @ORM\Column(name="repairDealer", type="string", length=255, nullable=true)
     */
    private $repairDealer;

    /**
     * @var string
     *
     * @ORM\Column(name="pdf", type="text")
     */
    private $pdf;

    /**
     * @var string
     *
     * @ORM\Column(name="companyLogo", type="text")
     */
    private $companyLogo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="timeSave", type="datetime")
     */
    private $timeSave;


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
     * Set operator
     *
     * @param string $operator
     * @return Document
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
     * Set monitoring
     *
     * @param string $monitoring
     * @return Document
     */
    public function setMonitoring($monitoring)
    {
        $this->monitoring = $monitoring;

        return $this;
    }

    /**
     * Get monitoring
     *
     * @return string 
     */
    public function getMonitoring()
    {
        return $this->monitoring;
    }

    /**
     * Set homeDealer
     *
     * @param string $homeDealer
     * @return Document
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
     * @return Document
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
     * Set pdf
     *
     * @param string $pdf
     * @return Document
     */
    public function setPdf($pdf)
    {
        $this->pdf = $pdf;

        return $this;
    }

    /**
     * Get pdf
     *
     * @return string 
     */
    public function getPdf()
    {
        return $this->pdf;
    }

    /**
     * Set companyLogo
     *
     * @param string $companyLogo
     * @return Document
     */
    public function setCompanyLogo($companyLogo)
    {
        $this->companyLogo = $companyLogo;

        return $this;
    }

    /**
     * Get companyLogo
     *
     * @return string 
     */
    public function getCompanyLogo()
    {
        return $this->companyLogo;
    }

    /**
     * Set timeSave
     *
     * @param \DateTime $timeSave
     * @return Document
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
}
