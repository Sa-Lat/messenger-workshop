<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 05.12.18
 * Time: 10:28
 */

namespace App\MessageHandler;


use App\Entity\Bet;
use App\Message\RegisterBet;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class RegisterBetHandler implements MessageHandlerInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function __invoke(RegisterBet $message)
    {
        $bet = new Bet();
        $bet->setGame($message->getGame())
            ->setUser($message->getUser())
            ->setLeftScore($message->getLeftScore())
            ->setRightScore($message->getRightScore());

        $this->entityManager->persist($bet);
        $this->entityManager->flush();
    }
}