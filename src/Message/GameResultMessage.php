<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 05.12.18
 * Time: 12:20
 */

namespace App\Message;


use App\Entity\Bet;

interface GameResultMessage
{
    /**
     * @return Bet
     */
    public function getBet(): Bet;
}