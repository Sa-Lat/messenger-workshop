<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 05.12.18
 * Time: 12:16
 */

namespace App\MessageHandler;


use App\Entity\Bet;
use App\Message\GameResultMessage;
use App\Message\Lost;
use App\Message\Won;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageSubscriberInterface;

class BetResultsHandler implements MessageSubscriberInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager
    )
    {
        $this->entityManager = $entityManager;
    }

    public function handleResult(GameResultMessage $message)
    {
        $bet = $message->getBet();
        $realBet = $this->entityManager->getRepository(Bet::class)->find($bet->getId());
        if($message instanceof Lost) {
            $realBet->setState(Bet::STATE_LOST);
        } elseif ($message instanceof Won) {
            $realBet->setState(Bet::STATE_WON);
        } else {
           throw new App\Exception\OppsException($message);
        }

        $this->entityManager->flush();
    }

    public static function getHandledMessages(): iterable
    {
        yield GameResultMessage::class => [
            'method' => 'handleResult',
            'bus' => 'event_bus',
        ];
    }
}