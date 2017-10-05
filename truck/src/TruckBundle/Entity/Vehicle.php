<?php

namespace TruckBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Vehicle
 *
 * @ORM\Table(name="vehicle")
 * @ORM\Entity(repositoryClass="TruckBundle\Repository\VehicleRepository")
 * @UniqueEntity("vin") 
 */
class Vehicle
{

    public function __construct() {
        $this->accidentCases = new ArrayCollection();
    }

    /**
     * @ORM\OneToMany(targetEntity="AccidentCase", mappedBy="vehicle")
     */
    private $accidentCases;
    
     /**
     * @ORM\ManyToOne(targetEntity="Dealer", inversedBy="vehicles")
     * @ORM\JoinColumn(name="dealer_id", referencedColumnName="id")
     */
    private $dealer;    

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    // https://pl.wikipedia.org/wiki/Vehicle_Identification_Number
    // Last 8 characters
    /**
     * @Assert\Type("string")
     * @Assert\Length(
     * min = 8,
     * max = 8,
     * exactMessage = "Enter last 8 characters from vin"
     * )        
     * @var string
     *
     * @ORM\Column(name="vin", type="string", length=255, unique=true)
     */
    private $vin;

    /**
     * @Assert\Type("string")
     * @Assert\Length(
     * min = 1,
     * max = 255,
     * minMessage = "Minimum number of characters is {{ limit }}",
     * maxMessage = "Maximum number of characters is {{ limit }}"
     * )        
     * @var string
     *
     * @ORM\Column(name="company_name", type="string", length=255)
     */
    private $companyName;

    /**
     * @Assert\Type("string")
     * @Assert\Length(
     * min = 1,
     * max = 255,
     * minMessage = "Minimum number of characters is {{ limit }}",
     * maxMessage = "Maximum number of characters is {{ limit }}"
     * )        
     * @var string
     *
     * @ORM\Column(name="tax_id_number", type="string", length=255)
     */
    private $taxIdNumber;

    /**
     * @Assert\Type("string")
     * @Assert\Length(
     * min = 1,
     * max = 255,
     * minMessage = "Minimum number of characters is {{ limit }}",
     * maxMessage = "Maximum number of characters is {{ limit }}"
     * )       
     * @var string
     *
     * @ORM\Column(name="contact_person", type="string", length=255)
     */
    private $contactPerson;

    /**
     * @Assert\Type("string")
     * @Assert\Length(
     * min = 1,
     * max = 255,
     * minMessage = "Minimum number of characters is {{ limit }}",
     * maxMessage = "Maximum number of characters is {{ limit }}"
     * )       
     * @var string
     *
     * @ORM\Column(name="street", type="string", length=255)
     */
    private $street;

    /**
     * @Assert\Regex(
     *     pattern="/[0-9][0-9]-[0-9][0-9][0-9]/",
     *     match=true,
     *     message="The right pattern is the DD-DDD (D as digit)"
     * )        
     * @var string
     *
     * @ORM\Column(name="zip_code", type="string", length=50)
     */
    private $zipCode;

    /**
     * @Assert\Type("string")
     * @Assert\Length(
     * min = 1,
     * max = 255,
     * minMessage = "Minimum number of characters is {{ limit }}",
     * maxMessage = "Maximum number of characters is {{ limit }}"
     * )        
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255)
     */
    private $city;

    /**
     * @Assert\Type("string")
     * @Assert\Length(
     * min = 1,
     * max = 255,
     * minMessage = "Minimum number of characters is {{ limit }}",
     * maxMessage = "Maximum number of characters is {{ limit }}"
     * )        
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * @Assert\Type("string")
     * @Assert\Length(
     * min = 1,
     * max = 255,
     * minMessage = "Minimum number of characters is {{ limit }}",
     * maxMessage = "Maximum number of characters is {{ limit }}"
     * )        
     * @var string
     *
     * @ORM\Column(name="fax", type="string", length=255, nullable=true)
     */
    private $fax;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=255, nullable=true)
     */
    private $mail;

    /**
     * @var string
     *
     * @ORM\Column(name="registration_number", type="string", length=255, nullable=true)
     */
    private $registrationNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="mileage", type="string", length=255, nullable=true)
     */
    private $mileage;

    /**
     * @var string
     *
     * @ORM\Column(name="guarantee_type", type="string", length=255, nullable=true)
     */
    private $guaranteeType;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="purchase_date", type="date", nullable=true)
     */
    private $purchaseDate;

    /**
     * @var string
     *
     * @ORM\Column(name="name_type", type="string", length=255, nullable=true)
     */
    private $nameType;


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
     * Set vin
     *
     * @param string $vin
     * @return Vehicle
     */
    public function setVin($vin)
    {
        $this->vin = $vin;

        return $this;
    }

    /**
     * Get vin
     *
     * @return string 
     */
    public function getVin()
    {
        return $this->vin;
    }

    /**
     * Set companyName
     *
     * @param string $companyName
     * @return Vehicle
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;

        return $this;
    }

    /**
     * Get companyName
     *
     * @return string 
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * Set taxIdNumber
     *
     * @param string $taxIdNumber
     * @return Vehicle
     */
    public function setTaxIdNumber($taxIdNumber)
    {
        $this->taxIdNumber = $taxIdNumber;

        return $this;
    }

    /**
     * Get taxIdNumber
     *
     * @return string 
     */
    public function getTaxIdNumber()
    {
        return $this->taxIdNumber;
    }

    /**
     * Set contactPerson
     *
     * @param string $contactPerson
     * @return Vehicle
     */
    public function setContactPerson($contactPerson)
    {
        $this->contactPerson = $contactPerson;

        return $this;
    }

    /**
     * Get contactPerson
     *
     * @return string 
     */
    public function getContactPerson()
    {
        return $this->contactPerson;
    }

    /**
     * Set street
     *
     * @param string $street
     * @return Vehicle
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     *
     * @return string 
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set zipCode
     *
     * @param string $zipCode
     * @return Vehicle
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    /**
     * Get zipCode
     *
     * @return string 
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return Vehicle
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return Vehicle
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set fax
     *
     * @param string $fax
     * @return Vehicle
     */
    public function setFax($fax)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax
     *
     * @return string 
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set mail
     *
     * @param string $mail
     * @return Vehicle
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string 
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set registrationNumber
     *
     * @param string $registrationNumber
     * @return Vehicle
     */
    public function setRegistrationNumber($registrationNumber)
    {
        $this->registrationNumber = $registrationNumber;

        return $this;
    }

    /**
     * Get registrationNumber
     *
     * @return string 
     */
    public function getRegistrationNumber()
    {
        return $this->registrationNumber;
    }

    /**
     * Set mileage
     *
     * @param string $mileage
     * @return Vehicle
     */
    public function setMileage($mileage)
    {
        $this->mileage = $mileage;

        return $this;
    }

    /**
     * Get mileage
     *
     * @return string 
     */
    public function getMileage()
    {
        return $this->mileage;
    }

    /**
     * Set guaranteeType
     *
     * @param string $guaranteeType
     * @return Vehicle
     */
    public function setGuaranteeType($guaranteeType)
    {
        $this->guaranteeType = $guaranteeType;

        return $this;
    }

    /**
     * Get guaranteeType
     *
     * @return string 
     */
    public function getGuaranteeType()
    {
        return $this->guaranteeType;
    }

    /**
     * Set purchaseDate
     *
     * @param \DateTime $purchaseDate
     * @return Vehicle
     */
    public function setPurchaseDate($purchaseDate)
    {
        $this->purchaseDate = $purchaseDate;

        return $this;
    }

    /**
     * Get purchaseDate
     *
     * @return \DateTime 
     */
    public function getPurchaseDate()
    {
        return $this->purchaseDate;
    }

    /**
     * Set nameType
     *
     * @param string $nameType
     * @return Vehicle
     */
    public function setNameType($nameType)
    {
        $this->nameType = $nameType;

        return $this;
    }

    /**
     * Get nameType
     *
     * @return string 
     */
    public function getNameType()
    {
        return $this->nameType;
    }

    /**
     * Add accidentCases
     *
     * @param \TruckBundle\Entity\AccidentCase $accidentCases
     * @return Vehicle
     */
    public function addAccidentCase(\TruckBundle\Entity\AccidentCase $accidentCases)
    {
        $this->accidentCases[] = $accidentCases;

        return $this;
    }

    /**
     * Remove accidentCases
     *
     * @param \TruckBundle\Entity\AccidentCase $accidentCases
     */
    public function removeAccidentCase(\TruckBundle\Entity\AccidentCase $accidentCases)
    {
        $this->accidentCases->removeElement($accidentCases);
    }

    /**
     * Get accidentCases
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAccidentCases()
    {
        return $this->accidentCases;
    }

    /**
     * Set dealer
     *
     * @param \TruckBundle\Entity\Dealer $dealer
     * @return Vehicle
     */
    public function setDealer(\TruckBundle\Entity\Dealer $dealer = null)
    {
        $this->dealer = $dealer;

        return $this;
    }

    /**
     * Get dealer
     *
     * @return \TruckBundle\Entity\Dealer 
     */
    public function getDealer()
    {
        return $this->dealer;
    }
}
