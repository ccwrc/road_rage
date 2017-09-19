<?php

namespace TruckBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * AccidentCase
 *
 * @ORM\Table(name="accident_case")
 * @ORM\Entity(repositoryClass="TruckBundle\Repository\AccidentCaseRepository")
 */
class AccidentCase
{
    
    public function __construct() {
        $this->monitorings = new ArrayCollection();
    }

    /**
     * @ORM\OneToMany(targetEntity="Monitoring", mappedBy="accidentCase")
     */
    private $monitorings;

    /**
     * @ORM\ManyToOne(targetEntity="Vehicle", inversedBy="accidentCases")
     * @ORM\JoinColumn(name="vehicle_id", referencedColumnName="id")
     */
    private $vehicle;


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
     * @ORM\Column(name="damage_description", type="text", length=30100)
     */
    private $damageDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="text", length=30100)
     */
    private $location;

    /**
     * @var string
     *
     * @ORM\Column(name="driver_contact", type="string", length=255)
     */
    private $driverContact;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="text", length=65000, nullable=true)
     */
    private $comment;

    /**
     * @var string
     *
     * @ORM\Column(name="info_sms", type="string", length=255, nullable=true)
     */
    private $infoSms;

    /**
     * @var string
     *
     * @ORM\Column(name="info_mail", type="string", length=255, nullable=true)
     */
    private $infoMail;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="progress_color", type="string", length=255)
     */
    private $progressColor;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time_start", type="datetime", nullable=true)
     */
    private $timeStart;    

    /**
     * @var int
     *
     * @ORM\Column(name="report_late", type="integer")
     */
    private $reportLate;

    /**
     * @var int
     *
     * @ORM\Column(name="report_rs_time", type="integer")
     */
    private $reportRsTime;

    /**
     * @var int
     *
     * @ORM\Column(name="report_nrs_time", type="integer")
     */
    private $reportNrsTime;

    /**
     * @var int
     *
     * @ORM\Column(name="report_repair_total", type="integer")
     */
    private $reportRepairTotal;

    /**
     * @var int
     *
     * @ORM\Column(name="report_arrival_time", type="integer")
     */
    private $reportArrivalTime;

    /**
     * @var int
     *
     * @ORM\Column(name="report_case_total", type="integer")
     */
    private $reportCaseTotal;

    /**
     * @var string
     *
     * @ORM\Column(name="report_repair_status", type="string", length=255, nullable=true)
     */
    private $reportRepairStatus;


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
     * Set damageDescription
     *
     * @param string $damageDescription
     * @return AccidentCase
     */
    public function setDamageDescription($damageDescription)
    {
        $this->damageDescription = $damageDescription;

        return $this;
    }

    /**
     * Get damageDescription
     *
     * @return string 
     */
    public function getDamageDescription()
    {
        return $this->damageDescription;
    }

    /**
     * Set location
     *
     * @param string $location
     * @return AccidentCase
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string 
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set driverContact
     *
     * @param string $driverContact
     * @return AccidentCase
     */
    public function setDriverContact($driverContact)
    {
        $this->driverContact = $driverContact;

        return $this;
    }

    /**
     * Get driverContact
     *
     * @return string 
     */
    public function getDriverContact()
    {
        return $this->driverContact;
    }

    /**
     * Set comment
     *
     * @param string $comment
     * @return AccidentCase
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string 
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set infoSms
     *
     * @param string $infoSms
     * @return AccidentCase
     */
    public function setInfoSms($infoSms)
    {
        $this->infoSms = $infoSms;

        return $this;
    }

    /**
     * Get infoSms
     *
     * @return string 
     */
    public function getInfoSms()
    {
        return $this->infoSms;
    }

    /**
     * Set infoMail
     *
     * @param string $infoMail
     * @return AccidentCase
     */
    public function setInfoMail($infoMail)
    {
        $this->infoMail = $infoMail;

        return $this;
    }

    /**
     * Get infoMail
     *
     * @return string 
     */
    public function getInfoMail()
    {
        return $this->infoMail;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return AccidentCase
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
     * Set reportLate
     *
     * @param integer $reportLate
     * @return AccidentCase
     */
    public function setReportLate($reportLate)
    {
        $this->reportLate = $reportLate;

        return $this;
    }

    /**
     * Get reportLate
     *
     * @return integer 
     */
    public function getReportLate()
    {
        return $this->reportLate;
    }

    /**
     * Set reportRsTime
     *
     * @param integer $reportRsTime
     * @return AccidentCase
     */
    public function setReportRsTime($reportRsTime)
    {
        $this->reportRsTime = $reportRsTime;

        return $this;
    }

    /**
     * Get reportRsTime
     *
     * @return integer 
     */
    public function getReportRsTime()
    {
        return $this->reportRsTime;
    }

    /**
     * Set reportNrsTime
     *
     * @param integer $reportNrsTime
     * @return AccidentCase
     */
    public function setReportNrsTime($reportNrsTime)
    {
        $this->reportNrsTime = $reportNrsTime;

        return $this;
    }

    /**
     * Get reportNrsTime
     *
     * @return integer 
     */
    public function getReportNrsTime()
    {
        return $this->reportNrsTime;
    }

    /**
     * Set reportRepairTotal
     *
     * @param integer $reportRepairTotal
     * @return AccidentCase
     */
    public function setReportRepairTotal($reportRepairTotal)
    {
        $this->reportRepairTotal = $reportRepairTotal;

        return $this;
    }

    /**
     * Get reportRepairTotal
     *
     * @return integer 
     */
    public function getReportRepairTotal()
    {
        return $this->reportRepairTotal;
    }

    /**
     * Set reportArrivalTime
     *
     * @param integer $reportArrivalTime
     * @return AccidentCase
     */
    public function setReportArrivalTime($reportArrivalTime)
    {
        $this->reportArrivalTime = $reportArrivalTime;

        return $this;
    }

    /**
     * Get reportArrivalTime
     *
     * @return integer 
     */
    public function getReportArrivalTime()
    {
        return $this->reportArrivalTime;
    }

    /**
     * Set reportCaseTotal
     *
     * @param integer $reportCaseTotal
     * @return AccidentCase
     */
    public function setReportCaseTotal($reportCaseTotal)
    {
        $this->reportCaseTotal = $reportCaseTotal;

        return $this;
    }

    /**
     * Get reportCaseTotal
     *
     * @return integer 
     */
    public function getReportCaseTotal()
    {
        return $this->reportCaseTotal;
    }

    /**
     * Set reportRepairStatus
     *
     * @param string $reportRepairStatus
     * @return AccidentCase
     */
    public function setReportRepairStatus($reportRepairStatus)
    {
        $this->reportRepairStatus = $reportRepairStatus;

        return $this;
    }

    /**
     * Get reportRepairStatus
     *
     * @return string 
     */
    public function getReportRepairStatus()
    {
        return $this->reportRepairStatus;
    }

    /**
     * Set vehicle
     *
     * @param \TruckBundle\Entity\Vehicle $vehicle
     * @return AccidentCase
     */
    public function setVehicle(\TruckBundle\Entity\Vehicle $vehicle = null)
    {
        $this->vehicle = $vehicle;

        return $this;
    }

    /**
     * Get vehicle
     *
     * @return \TruckBundle\Entity\Vehicle 
     */
    public function getVehicle()
    {
        return $this->vehicle;
    }

    /**
     * Add monitorings
     *
     * @param \TruckBundle\Entity\Monitoring $monitorings
     * @return AccidentCase
     */
    public function addMonitoring(\TruckBundle\Entity\Monitoring $monitorings)
    {
        $this->monitorings[] = $monitorings;

        return $this;
    }

    /**
     * Remove monitorings
     *
     * @param \TruckBundle\Entity\Monitoring $monitorings
     */
    public function removeMonitoring(\TruckBundle\Entity\Monitoring $monitorings)
    {
        $this->monitorings->removeElement($monitorings);
    }

    /**
     * Get monitorings
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMonitorings()
    {
        return $this->monitorings;
    }

    /**
     * Set progressColor
     *
     * @param string $progressColor
     * @return AccidentCase
     */
    public function setProgressColor($progressColor)
    {
        $this->progressColor = $progressColor;

        return $this;
    }

    /**
     * Get progressColor
     *
     * @return string 
     */
    public function getProgressColor()
    {
        return $this->progressColor;
    }


    /**
     * Set timeStart
     *
     * @param \DateTime $timeStart
     * @return AccidentCase
     */
    public function setTimeStart($timeStart)
    {
        $this->timeStart = $timeStart;

        return $this;
    }

    /**
     * Get timeStart
     *
     * @return \DateTime 
     */
    public function getTimeStart()
    {
        return $this->timeStart;
    }
}
