<?php

namespace TruckBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vehicle
 *
 * @ORM\Table(name="vehicle")
 * @ORM\Entity(repositoryClass="TruckBundle\Repository\VehicleRepository")
 */
class Vehicle
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
     * @ORM\Column(name="vin", type="string", length=255, unique=true)
     */
    private $vin;

    /**
     * @var string
     *
     * @ORM\Column(name="companyName", type="string", length=255, nullable=true)
     */
    private $companyName;

    /**
     * @var string
     *
     * @ORM\Column(name="taxIdentificationNumber", type="string", length=255, nullable=true)
     */
    private $taxIdentificationNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="contact", type="string", length=255, nullable=true)
     */
    private $contact;

    /**
     * @var string
     *
     * @ORM\Column(name="street", type="string", length=255, nullable=true)
     */
    private $street;

    /**
     * @var string
     *
     * @ORM\Column(name="zipCode", type="string", length=255, nullable=true)
     */
    private $zipCode;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255, nullable=true)
     */
    private $phone;

    /**
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
     * @ORM\Column(name="registrationNumber", type="string", length=255, nullable=true)
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
     * @ORM\Column(name="guaranteeType", type="string", length=255, nullable=true)
     */
    private $guaranteeType;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="purchaseDate", type="date", nullable=true)
     */
    private $purchaseDate;

    /**
     * @var string
     *
     * @ORM\Column(name="homeDealer", type="string", length=255, nullable=true)
     */
    private $homeDealer;

    /**
     * @var string
     *
     * @ORM\Column(name="nameType", type="string", length=255, nullable=true)
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
     * Set taxIdentificationNumber
     *
     * @param string $taxIdentificationNumber
     * @return Vehicle
     */
    public function setTaxIdentificationNumber($taxIdentificationNumber)
    {
        $this->taxIdentificationNumber = $taxIdentificationNumber;

        return $this;
    }

    /**
     * Get taxIdentificationNumber
     *
     * @return string 
     */
    public function getTaxIdentificationNumber()
    {
        return $this->taxIdentificationNumber;
    }

    /**
     * Set contact
     *
     * @param string $contact
     * @return Vehicle
     */
    public function setContact($contact)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get contact
     *
     * @return string 
     */
    public function getContact()
    {
        return $this->contact;
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
     * Set homeDealer
     *
     * @param string $homeDealer
     * @return Vehicle
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
}