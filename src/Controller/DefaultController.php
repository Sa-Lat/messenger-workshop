<?php

namespace App\Controller;

use App\Message\GetBets;
use App\Message\RegisterBet;
use App\Message\ReportResult;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @Template()
     * @param Request $request
     * @param MessageBusInterface $messageBus
     * @return array
     */
    public function index(Request $request, MessageBusInterface $messageBus)
    {
        $message = '';

        if ($request->isMethod('post')) {

            $messageBus->dispatch(new RegisterBet(
                $request->get('user'),
                $request->get('game'),
                $request->request->getInt('leftScore'),
                $request->request->getInt('rightScore')
            ));

            $message = 'OK';
        }

        $envelope = $messageBus->dispatch(new GetBets());
        /** @var HandledStamp $handledStamp */
        $handledStamp = $envelope->last(HandledStamp::class);


        return [
            'message' => $message,
            'bets' => $handledStamp->getResult()
        ];
    }

    /**
     * @Route("/report", name="report")
     * @Template()
     * @param Request $request
     * @param MessageBusInterface $messageBus
     * @return RedirectResponse
     */
    public function report(Request $request, MessageBusInterface $messageBus)
    {
        if ($request->isMethod('post')) {
            $messageBus->dispatch(new ReportResult(
                $request->get('game'),
                $request->request->getInt('leftScore'),
                $request->request->getInt('rightScore')
            ));
        }

        return new RedirectResponse($this->generateUrl('home'));
    }
}
