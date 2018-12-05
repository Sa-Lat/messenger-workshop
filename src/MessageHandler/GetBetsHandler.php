<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 05.12.18
 * Time: 10:51
 */

namespace App\MessageHandler;


use App\Entity\Bet;
use App\Message\GetBets;
use App\Repository\BetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class GetBetsHandler implements MessageHandlerInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var BetRepository
     */
    private $betRepository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->betRepository = $this->entityManager->getRepository(Bet::class);
    }

    public function __invoke(GetBets $message)
    {
        return $this->betRepository->findAll();
    }
}