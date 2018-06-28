<?php

declare(strict_types=1);

namespace TruckBundle\Presenter;

use Symfony\Component\Validator\Constraints as Assert;

class UserFindPresenter
{
    /**
     * @Assert\Type("string")
     * @Assert\Length(
     * max = 255,
     * maxMessage = "Maximum number of characters is {{ limit }}"
     * )
     * @var string
     */
    private $pieceOfEmail = '';

    /**
     * @Assert\Type("string")
     * @Assert\Length(
     * max = 255,
     * maxMessage = "Maximum number of characters is {{ limit }}"
     * )
     * @var string
     */
    private $pieceOfUsername = '';

    /**
     * @return null|string
     */
    public function getPieceOfEmail(): ?string
    {
        return $this->pieceOfEmail;
    }

    /**
     * @param null|string $pieceOfEmail
     */
    public function setPieceOfEmail(?string $pieceOfEmail): void
    {
        $this->pieceOfEmail = $pieceOfEmail;
    }

    /**
     * @return null|string
     */
    public function getPieceOfUsername(): ?string
    {
        return $this->pieceOfUsername;
    }

    /**
     * @param null|string $pieceOfUsername
     */
    public function setPieceOfUsername(?string $pieceOfUsername): void
    {
        $this->pieceOfUsername = $pieceOfUsername;
    }
}
