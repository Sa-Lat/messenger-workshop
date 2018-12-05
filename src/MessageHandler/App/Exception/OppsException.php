<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 05.12.18
 * Time: 14:36
 */

namespace App\MessageHandler\App\Exception;


use Symfony\Component\Messenger\Transport\AmqpExt\Exception\RejectMessageExceptionInterface;

class OppsException extends \Exception implements RejectMessageExceptionInterface {

}