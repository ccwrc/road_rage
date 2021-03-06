<?php

namespace TruckBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Dealer
 *
 * @ORM\Table(name="dealer")
 * @ORM\Entity(repositoryClass="TruckBundle\Repository\DealerRepository")
 * @UniqueEntity("name")
 * @UniqueEntity("mainMail")
 */
class Dealer
{

    public static $dealerIsActive = 'active';
    public static $dealerIsInactive = 'inactive';
    public static $dealerIsSuspended = 'suspended';

    public function __construct()
    {
        $this->vehicles = new ArrayCollection();
    }

    /**
     * @ORM\OneToMany(targetEntity="Vehicle", mappedBy="dealer")
     */
    private $vehicles;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @Assert\Type("string")
     * @Assert\Length(
     * min = 2,
     * max = 255,
     * minMessage = "Minimum number of characters is {{ limit }}",
     * maxMessage = "Maximum number of characters is {{ limit }}"
     * )
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @Assert\Type("string")
     * @Assert\Length(
     * min = 3,
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
     * min = 3,
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
     * min = 9,
     * max = 255,
     * minMessage = "Minimum number of characters is {{ limit }}",
     * maxMessage = "Maximum number of characters is {{ limit }}"
     * )
     * @var string
     *
     * @ORM\Column(name="main_phone", type="string", length=255)
     */
    private $mainPhone;

    /**
     * @Assert\Type("string")
     * @Assert\Length(
     * min = 9,
     * max = 255,
     * minMessage = "Minimum number of characters is {{ limit }}",
     * maxMessage = "Maximum number of characters is {{ limit }}"
     * )
     * @var string
     *
     * @ORM\Column(name="main_fax", type="string", length=255, nullable=true)
     */
    private $mainFax;

    /**
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = false
     * )
     * @Assert\Length(
     * min = 5,
     * max = 255,
     * minMessage = "Minimum number of characters is {{ limit }}",
     * maxMessage = "Maximum number of characters is {{ limit }}"
     * )
     * @var string
     *
     * @ORM\Column(name="main_mail", type="string", length=255, unique=true)
     */
    private $mainMail;

    /**
     * @Assert\Type("string")
     * @Assert\Length(
     * min = 9,
     * max = 255,
     * minMessage = "Minimum number of characters is {{ limit }}",
     * maxMessage = "Maximum number of characters is {{ limit }}"
     * )
     * @var string
     *
     * @ORM\Column(name="phone_24h", type="string", length=255, nullable=true)
     */
    private $phone24h;

    /**
     * @Assert\Type("string")
     * @Assert\Length(
     * min = 9,
     * max = 255,
     * minMessage = "Minimum number of characters is {{ limit }}",
     * maxMessage = "Maximum number of characters is {{ limit }}"
     * )
     * @var string
     *
     * @ORM\Column(name="phone_service_car", type="string", length=255, nullable=true)
     */
    private $phoneServiceCar;

    /**
     * @Assert\Type("string")
     * @Assert\Length(
     * min = 9,
     * max = 255,
     * minMessage = "Minimum number of characters is {{ limit }}",
     * maxMessage = "Maximum number of characters is {{ limit }}"
     * )
     * @var string
     *
     * @ORM\Column(name="alt_phone_1", type="string", length=255, nullable=true)
     */
    private $altPhone1;

    /**
     * @Assert\Type("string")
     * @Assert\Length(
     * min = 9,
     * max = 255,
     * minMessage = "Minimum number of characters is {{ limit }}",
     * maxMessage = "Maximum number of characters is {{ limit }}"
     * )
     * @var string
     *
     * @ORM\Column(name="alt_phone_2", type="string", length=255, nullable=true)
     */
    private $altPhone2;

    /**
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true
     * )
     * @Assert\Length(
     * min = 5,
     * max = 255,
     * minMessage = "Minimum number of characters is {{ limit }}",
     * maxMessage = "Maximum number of characters is {{ limit }}"
     * )
     * @var string
     *
     * @ORM\Column(name="alt_mail_1", type="string", length=255, nullable=true)
     */
    private $altMail1;

    /**
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true
     * )
     * @Assert\Length(
     * min = 5,
     * max = 255,
     * minMessage = "Minimum number of characters is {{ limit }}",
     * maxMessage = "Maximum number of characters is {{ limit }}"
     * )
     * @var string
     *
     * @ORM\Column(name="alt_mail_2", type="string", length=255, nullable=true)
     */
    private $altMail2;

    /**
     * @Assert\Type("string")
     * @Assert\Length(
     * min = 3,
     * max = 65000,
     * minMessage = "Minimum number of characters is {{ limit }}",
     * maxMessage = "Maximum number of characters is {{ limit }}"
     * )
     * @var string
     *
     * @ORM\Column(name="other_comments", type="text", length=65000, nullable=true)
     */
    private $otherComments;

    /**
     * @Assert\Choice({"active", "inactive", "suspended"})
     * @var string
     *
     * @ORM\Column(name="is_active", type="string", length=100)
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

    /**
     * Add vehicles
     *
     * @param Vehicle $vehicles
     * @return Dealer
     */
    public function addVehicle(Vehicle $vehicles)
    {
        $this->vehicles[] = $vehicles;

        return $this;
    }

    /**
     * Remove vehicles
     *
     * @param Vehicle $vehicles
     */
    public function removeVehicle(Vehicle $vehicles)
    {
        $this->vehicles->removeElement($vehicles);
    }

    /**
     * Get vehicles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVehicles()
    {
        return $this->vehicles;
    }
}
