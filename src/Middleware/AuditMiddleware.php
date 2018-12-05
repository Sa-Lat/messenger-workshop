<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 05.12.18
 * Time: 14:46
 */

namespace App\Middleware;


use App\Stamp\IdStamp;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Middleware\MiddlewareInterface;
use Symfony\Component\Messenger\Middleware\StackInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Messenger\Stamp\ReceivedStamp;
use Symfony\Component\Messenger\Stamp\SentStamp;

class AuditMiddleware implements MiddlewareInterface
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(LoggerInterface $queueLogger)
    {
        $this->logger = $queueLogger;
    }

    public function handle(Envelope $envelope, StackInterface $stack): Envelope
    {
        if (null == $envelope->last(IdStamp::class)) {
            $envelope = $envelope->with(new IdStamp());
        }

        if (null !== $envelope->last(ReceivedStamp::class)) {
            $this->log("received", $envelope);
        } else {
            $this->log("dispatched", $envelope);
        }

        $envelope = $stack->next()->handle($envelope, $stack);

        if (null !== $envelope->last(SentStamp::class)) {
            $this->log("send", $envelope);
        } else if (null !== $envelope->last(HandledStamp::class)) {
            $this->log("handled", $envelope);
        } else {
           $this->log("dont know", $envelope);
        }



        return $envelope;
    }

    private function log($prefix, $envelope) {
        $this->logger->info($prefix . " " . $envelope->last(IdStamp::class) . " " . get_class($envelope->getMessage()));
    }
}