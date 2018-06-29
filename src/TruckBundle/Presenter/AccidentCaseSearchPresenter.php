<?php

declare(strict_types=1);

namespace TruckBundle\Presenter;

use Symfony\Component\Validator\Constraints as Assert;

class AccidentCaseSearchPresenter
{
    /**
     * @Assert\Type("int")
     * @var int
     */
    private $caseId;

    /**
     * @Assert\Type("string")
     * @Assert\Length(
     * max = 600,
     * maxMessage = "Maximum number of characters is {{ limit }}"
     * )
     * @var string
     */
    private $companyName;

    /**
     * @Assert\Type("string")
     * @Assert\Length(
     * max = 600,
     * maxMessage = "Maximum number of characters is {{ limit }}"
     * )
     * @var string
     */
    private $damageDescription;

    /**
     * @Assert\Type("string")
     * @Assert\Length(
     * max = 600,
     * maxMessage = "Maximum number of characters is {{ limit }}"
     * )
     * @var string
     */
    private $truckLocation;

    /**
     * @return int
     */
    public function getCaseId(): ?int
    {
        return $this->caseId;
    }

    /**
     * @param int $caseId
     */
    public function setCaseId(?int $caseId): void
    {
        $this->caseId = $caseId;
    }

    /**
     * @return string
     */
    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    /**
     * @param string $companyName
     */
    public function setCompanyName(?string $companyName): void
    {
        $this->companyName = $companyName;
    }

    /**
     * @return string
     */
    public function getDamageDescription(): ?string
    {
        return $this->damageDescription;
    }

    /**
     * @param string $damageDescription
     */
    public function setDamageDescription(?string $damageDescription): void
    {
        $this->damageDescription = $damageDescription;
    }

    /**
     * @return string
     */
    public function getTruckLocation(): ?string
    {
        return $this->truckLocation;
    }

    /**
     * @param string $truckLocation
     */
    public function setTruckLocation(?string $truckLocation): void
    {
        $this->truckLocation = $truckLocation;
    }
}
