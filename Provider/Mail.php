<?php

namespace DocDocDoc\NexmoBundle\Provider;

use DocDocDoc\NexmoBundle\Message\MessageInterface;
use DocDocDoc\NexmoBundle\Response\NexmoResponse;

class Mail implements ProviderInterface
{
    private $mailTo;
    private $mailer;

    public function __construct($mailTo, $mailFrom, \Swift_Mailer $mailer)
    {
        $this->mailTo = $mailTo;
        $this->mailFrom = $mailFrom;
        $this->mailer = $mailer;
    }

    public function send(MessageInterface $message)
    {
        $body = <<<MAIL
Hi,

You've just receive a new SMS from "{$message->from}" at phone "{$message->to}" :

{$message->text}

Regards
DocDocDocNexmoBundle

MAIL;

        $email = \Swift_Message::newInstance()
            ->setSubject('[SMS] From : '.$message->from)
            ->setTo($this->mailTo)
            ->setFrom($this->mailFrom)
            ->setBody($body)
        ;

        $this->mailer->send($email);

        return new NexmoResponse([
            'message-count' => 1,
            'messages'      => [
                'status'            => 0,
                'message-id'        => 'sent-by-mail',
                'to'                => $message->to.'|'.$this->mailTo,
                'remaining-balance' => -1,
                'message-price'     => 0,
                'network'           => '001'
            ]
        ]);
    }
}
