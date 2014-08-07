<?php

namespace DocDocDoc\NexmoBundle\Provider;

use DocDocDoc\NexmoBundle\Message\MessageInterface;

interface ProviderInterface
{
    public function send(MessageInterface $message);
}