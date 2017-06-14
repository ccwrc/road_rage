<?php

namespace TruckBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Dealer
 *
 * @ORM\Table(name="dealer")
 * @ORM\Entity(repositoryClass="TruckBundle\Repository\DealerRepository")
 */
class Dealer
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="street", type="string", length=255)
     */
    private $street;

    /**
     * @var string
     *
     * @ORM\Column(name="zipCode", type="string", length=20)
     */
    private $zipCode;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="mainPhone", type="string", length=255)
     */
    private $mainPhone;

    /**
     * @var string
     *
     * @ORM\Column(name="mainFax", type="string", length=255)
     */
    private $mainFax;

    /**
     * @var string
     *
     * @ORM\Column(name="mainMail", type="string", length=255, unique=true)
     */
    private $mainMail;

    /**
     * @var string
     *
     * @ORM\Column(name="phone24h", type="string", length=255)
     */
    private $phone24h;

    /**
     * @var string
     *
     * @ORM\Column(name="phoneServiceCar", type="string", length=255, nullable=true)
     */
    private $phoneServiceCar;

    /**
     * @var string
     *
     * @ORM\Column(name="altPhone1", type="string", length=255, nullable=true)
     */
    private $altPhone1;

    /**
     * @var string
     *
     * @ORM\Column(name="altPhone2", type="string", length=255, nullable=true)
     */
    private $altPhone2;

    /**
     * @var string
     *
     * @ORM\Column(name="altMail1", type="string", length=255, nullable=true)
     */
    private $altMail1;

    /**
     * @var string
     *
     * @ORM\Column(name="altMail2", type="string", length=255, nullable=true)
     */
    private $altMail2;

    /**
     * @var string
     *
     * @ORM\Column(name="otherComments", type="string", length=9500, nullable=true)
     */
    private $otherComments;

    /**
     * @var string
     *
     * @ORM\Column(name="isActive", type="string", length=100)
     */
    private $isActive;


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
     * Set name
     *
     * @param string $name
     * @return Dealer
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set street
     *
     * @param string $street
     * @return Dealer
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
     * @return Dealer
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
     * @return Dealer
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
     * Set mainPhone
     *
     * @param string $mainPhone
     * @return Dealer
     */
    public function setMainPhone($mainPhone)
    {
        $this->mainPhone = $mainPhone;

        return $this;
    }

    /**
     * Get mainPhone
     *
     * @return string 
     */
    public function getMainPhone()
    {
        return $this->mainPhone;
    }

    /**
     * Set mainFax
     *
     * @param string $mainFax
     * @return Dealer
     */
    public function setMainFax($mainFax)
    {
        $this->mainFax = $mainFax;

        return $this;
    }

    /**
     * Get mainFax
     *
     * @return string 
     */
    public function getMainFax()
    {
        return $this->mainFax;
    }

    /**
     * Set mainMail
     *
     * @param string $mainMail
     * @return Dealer
     */
    public function setMainMail($mainMail)
    {
        $this->mainMail = $mainMail;

        return $this;
    }

    /**
     * Get mainMail
     *
     * @return string 
     */
    public function getMainMail()
    {
        return $this->mainMail;
    }

    /**
     * Set phone24h
     *
     * @param string $phone24h
     * @return Dealer
     */
    public function setPhone24h($phone24h)
    {
        $this->phone24h = $phone24h;

        return $this;
    }

    /**
     * Get phone24h
     *
     * @return string 
     */
    public function getPhone24h()
    {
        return $this->phone24h;
    }

    /**
     * Set phoneServiceCar
     *
     * @param string $phoneServiceCar
     * @return Dealer
     */
    public function setPhoneServiceCar($phoneServiceCar)
    {
        $this->phoneServiceCar = $phoneServiceCar;

        return $this;
    }

    /**
     * Get phoneServiceCar
     *
     * @return string 
     */
    public function getPhoneServiceCar()
    {
        return $this->phoneServiceCar;
    }

    /**
     * Set altPhone1
     *
     * @param string $altPhone1
     * @return Dealer
     */
    public function setAltPhone1($altPhone1)
    {
        $this->altPhone1 = $altPhone1;

        return $this;
    }

    /**
     * Get altPhone1
     *
     * @return string 
     */
    public function getAltPhone1()
    {
        return $this->altPhone1;
    }

    /**
     * Set altPhone2
     *
     * @param string $altPhone2
     * @return Dealer
     */
    public function setAltPhone2($altPhone2)
    {
        $this->altPhone2 = $altPhone2;

        return $this;
    }

    /**
     * Get altPhone2
     *
     * @return string 
     */
    public function getAltPhone2()
    {
        return $this->altPhone2;
    }

    /**
     * Set altMail1
     *
     * @param string $altMail1
     * @return Dealer
     */
    public function setAltMail1($altMail1)
    {
        $this->altMail1 = $altMail1;

        return $this;
    }

    /**
     * Get altMail1
     *
     * @return string 
     */
    public function getAltMail1()
    {
        return $this->altMail1;
    }

    /**
     * Set altMail2
     *
     * @param string $altMail2
     * @return Dealer
     */
    public function setAltMail2($altMail2)
    {
        $this->altMail2 = $altMail2;

        return $this;
    }

    /**
     * Get altMail2
     *
     * @return string 
     */
    public function getAltMail2()
    {
        return $this->altMail2;
    }

    /**
     * Set otherComments
     *
     * @param string $otherComments
     * @return Dealer
     */
    public function setOtherComments($otherComments)
    {
        $this->otherComments = $otherComments;

        return $this;
    }

    /**
     * Get otherComments
     *
     * @return string 
     */
    public function getOtherComments()
    {
        return $this->otherComments;
    }

    /**
     * Set isActive
     *
     * @param string $isActive
     * @return Dealer
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return string 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }
}