<?php

namespace DocDocDoc\NexmoBundle\Provider;

use DocDocDoc\NexmoBundle\Message\MessageInterface;
use DocDocDoc\NexmoBundle\Response\NexmoResponse;

class Noop implements ProviderInterface
{
    public function send(MessageInterface $message)
    {
        return new NexmoResponse([
            'message-count' => 1,
            'messages'      => [
                'status'            => 0,
                'message-id'        => 'no-message-sent',
                'to'                => $message->to,
                'remaining-balance' => -1,
                'message-price'     => 0,
                'network'           => '001'
            ]
        ]);
    }
}