<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BetRepository")
 */
class Bet
{
    const STATE_INITIAL = 0;
    const STATE_LOST = 1;
    const STATE_WON = 2;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $game;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $leftScore;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $rightScore;

    /**
     * @ORM\Column(type="integer", options={"default":0})
     * @var int
     */
    private $state = Bet::STATE_INITIAL;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getGame(): ?string
    {
        return $this->game;
    }

    public function setGame(string $game): self
    {
        $this->game = $game;

        return $this;
    }

    public function getUser(): ?string
    {
        return $this->user;
    }

    public function setUser(string $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getLeftScore(): ?string
    {
        return $this->leftScore;
    }

    public function setLeftScore(string $leftScore): self
    {
        $this->leftScore = $leftScore;

        return $this;
    }

    public function getRightScore(): ?string
    {
        return $this->rightScore;
    }

    public function setRightScore(string $rightScore): self
    {
        $this->rightScore = $rightScore;

        return $this;
    }

    /**
     * @return int
     */
    public function getState(): int
    {
        return $this->state;
    }

    /**
     * @param int $state
     */
    public function setState(int $state): void
    {
        $this->state = $state;
    }
}
