<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 05.12.18
 * Time: 10:18
 */

namespace App\Message;


class RegisterBet
{
    private $user;
    private $game;
    private $leftScore;
    private $rightScore;

    public function __construct($user, $game, $leftScore, $rightScore)
    {

        $this->user = $user;
        $this->game = $game;
        $this->leftScore = $leftScore;
        $this->rightScore = $rightScore;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     * @return RegisterBet
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGame()
    {
        return $this->game;
    }

    /**
     * @param mixed $game
     * @return RegisterBet
     */
    public function setGame($game)
    {
        $this->game = $game;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLeftScore()
    {
        return $this->leftScore;
    }

    /**
     * @param mixed $leftScore
     * @return RegisterBet
     */
    public function setLeftScore($leftScore)
    {
        $this->leftScore = $leftScore;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRightScore()
    {
        return $this->rightScore;
    }

    /**
     * @param mixed $rightScore
     * @return RegisterBet
     */
    public function setRightScore($rightScore)
    {
        $this->rightScore = $rightScore;
        return $this;
    }
}