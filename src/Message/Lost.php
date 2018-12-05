<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 05.12.18
 * Time: 11:48
 */

namespace App\Message;


use App\Entity\Bet;

class Lost implements GameResultMessage
{
    /**
     * @var Bet
     */
    private $bet;

    public function __construct(
       Bet $bet
   )
   {
       $this->bet = $bet;
   }

    /**
     * @return Bet
     */
    public function getBet(): Bet
    {
       return $this->bet;
    }
}