<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 05.12.18
 * Time: 11:38
 */

namespace App\Message;


class ReportResult
{
    /**
     * @var string
     */
    private $game;
    /**
     * @var int
     */
    private $leftScore;
    /**
     * @var int
     */
    private $rightScore;

    public function __construct(
        string $game,
        int $leftScore,
        int $rightScore
    )
    {
        $this->game = $game;
        $this->leftScore = $leftScore;
        $this->rightScore = $rightScore;
    }

    /**
     * @return string
     */
    public function getGame(): string
    {
        return $this->game;
    }

    /**
     * @param string $game
     * @return ReportResult
     */
    public function setGame(string $game): ReportResult
    {
        $this->game = $game;
        return $this;
    }

    /**
     * @return int
     */
    public function getLeftScore(): int
    {
        return $this->leftScore;
    }

    /**
     * @param int $leftScore
     * @return ReportResult
     */
    public function setLeftScore(int $leftScore): ReportResult
    {
        $this->leftScore = $leftScore;
        return $this;
    }

    /**
     * @return int
     */
    public function getRightScore(): int
    {
        return $this->rightScore;
    }

    /**
     * @param int $rightScore
     * @return ReportResult
     */
    public function setRightScore(int $rightScore): ReportResult
    {
        $this->rightScore = $rightScore;
        return $this;
    }


}