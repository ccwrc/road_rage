<?php

namespace TruckBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Monitoring
 *
 * @ORM\Table(name="monitoring")
 * @ORM\Entity(repositoryClass="TruckBundle\Repository\MonitoringRepository")
 */
class Monitoring
{
    // START new accident case
    public static $codeStart = 'START';
    // Payment Guarantee (request)
    public static $codePg = 'PG';
    // Confirmation Payment Guarantee
    public static $codeCpg = 'CPG';
    // Repair Order
    public static $codeRo = 'RO';
    // Estimated Arrival Time (dealer → client)
    public static $codeEta = 'ETA';
    // STaRt Repair
    public static $codeStrr = 'STRR';
    // Incoming: General purpose code. Incoming phone call/fax/mail/etc.
    public static $codeIncoming = 'Incoming';
    // Out: General purpose code. Outgoing phone call/fax/mail/etc.
    public static $codeOut = 'Out';
    // Withdrawal Payment Guarantee
    public static $codeWpg = 'WPG';
    // Withdrawal Confirmation Payment Guarantee
    public static $codeWcpg = 'WCPG';
    // Withdrawal Repair Order
    public static $codeWro = 'WRO';
    // END accident case
    public static $codeEnd = 'END';

    // 1 - document send (success)
    public static $documentSend = 1;
    // 0 (fail) or NULL (initial state) - not send
    public static $documentNotSend = 0;

    public function __construct()
    {
        $this->timeSave = new \DateTime("now");
    }

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
     * @Assert\Type("string")
     * @Assert\Length(
     * min = 2,
     * max = 255
     * )
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=255)
     */
    private $code;

    /**
     * @Assert\Type("string")
     * @Assert\Length(
     * min = 1,
     * max = 600
     * )
     * @var string
     *
     * @ORM\Column(name="operator", type="string", length=600)
     */
    private $operator;

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
     * @ORM\Column(name="time_set", type="datetime", nullable=true)
     */
    private $timeSet;

    /**
     * @Assert\Type("string")
     * @Assert\Length(
     * min = 3,
     * max = 5000,
     * minMessage = "Minimum number of characters is {{ limit }}",
     * maxMessage = "Maximum number of characters is {{ limit }}"
     * )
     * @var string
     *
     * @ORM\Column(name="contact_through", type="text")
     */
    private $contactThrough;

    /**
     * @Assert\Type("string")
     * @Assert\Length(
     * min = 1,
     * max = 65000,
     * minMessage = "Minimum number of characters is {{ limit }}",
     * maxMessage = "Maximum number of characters is {{ limit }}"
     * )
     * @var string
     *
     * @ORM\Column(name="comments", type="text")
     */
    private $comments;

    /**
     * @Assert\Type("string")
     * @Assert\Length(
     * min = 3,
     * max = 9000,
     * minMessage = "Minimum number of characters is {{ limit }}",
     * maxMessage = "Maximum number of characters is {{ limit }}"
     * )
     * @var string
     *
     * @ORM\Column(name="out_comment", type="text", nullable=true)
     */
    private $outComment;

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
     * @ORM\Column(name="contact_mail", type="string", length=255, nullable=true)
     */
    private $contactMail;

    /**
     * @Assert\Type("string")
     * @Assert\Length(
     * min = 5,
     * max = 600,
     * minMessage = "Minimum number of characters is {{ limit }}",
     * maxMessage = "Maximum number of characters is {{ limit }}"
     * )
     * @var string
     *
     * @ORM\Column(name="optional_mails", type="string", length=600, nullable=true)
     */
    private $optionalMails;

    /**
     * @Assert\Type("numeric")
     * @Assert\Length(
     * min = 1,
     * max = 10,
     * minMessage = "Minimum number of characters is {{ limit }}",
     * maxMessage = "Maximum number of characters is {{ limit }}"
     * )
     * @var int
     *
     * @ORM\Column(name="amount", type="integer", nullable=true)
     */
    private $amount;

    /**
     * @Assert\Choice({"PLN", "USD", "EUR"})
     * @var string
     *
     * @ORM\Column(name="currency", type="string", length=100, nullable=true)
     */
    private $currency;

    /**
     * 1 - document send (success)
     * 0 or NULL - not send
     * @var int
     *
     * @ORM\Column(name="is_document_send", type="smallint", nullable=true)
     */
    private $isDocumentSend;


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
     * @param AccidentCase $accidentCase
     * @return Monitoring
     */
    public function setAccidentCase(AccidentCase $accidentCase = null)
    {
        $this->accidentCase = $accidentCase;

        return $this;
    }

    /**
     * Get accidentCase
     *
     * @return AccidentCase
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
     * @param Dealer $homeDealer
     * @return Monitoring
     */
    public function setHomeDealer(Dealer $homeDealer = null)
    {
        $this->homeDealer = $homeDealer;

        return $this;
    }

    /**
     * Get homeDealer
     *
     * @return Dealer
     */
    public function getHomeDealer()
    {
        return $this->homeDealer;
    }

    /**
     * Set repairDealer
     *
     * @param Dealer $repairDealer
     * @return Monitoring
     */
    public function setRepairDealer(Dealer $repairDealer = null)
    {
        $this->repairDealer = $repairDealer;

        return $this;
    }

    /**
     * Get repairDealer
     *
     * @return Dealer
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

    /**
     * Set isDocumentSend
     *
     * @param integer $isDocumentSend
     * @return Monitoring
     */
    public function setIsDocumentSend($isDocumentSend)
    {
        $this->isDocumentSend = $isDocumentSend;

        return $this;
    }

    /**
     * Get isDocumentSend
     *
     * @return int|null
     */
    public function getIsDocumentSend()
    {
        return $this->isDocumentSend;
    }
}
