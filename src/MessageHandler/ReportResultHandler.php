<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 05.12.18
 * Time: 11:41
 */

namespace App\MessageHandler;


use App\Entity\Bet;
use App\Message\Lost;
use App\Message\ReportResult;
use App\Message\Won;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class ReportResultHandler implements MessageHandlerInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var MessageBusInterface
     */
    private $messageBus;

    public function __construct(EntityManagerInterface $entityManager, MessageBusInterface $eventBus)
    {
        $this->entityManager = $entityManager;
        $this->messageBus = $eventBus;
    }

    public function __invoke(ReportResult $message)
    {
        $bets = $this->entityManager
            ->getRepository(Bet::class)
            ->findBy(['game' => $message->getGame(), 'state' => Bet::STATE_INITIAL]);

        foreach ($bets as $bet) {
            if (
                $bet->getLeftScore() == $message->getLeftScore() &&
                $bet->getRightScore() == $message->getRightScore()
            ) {
                $this->messageBus->dispatch(new Won($bet));
            } else {
                $this->messageBus->dispatch(new Lost($bet));
            }
        }
    }
}