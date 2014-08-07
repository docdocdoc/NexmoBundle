<?php

namespace DocDocDoc\NexmoBundle\Response;

class NexmoResponse
{
    private $jsonResponse;

    public function __construct(array $jsonResponse)
    {
        $this->jsonResponse = $jsonResponse;
    }

    public function getMessages()
    {
        return $this->jsonResponse['messages'];
    }

    public function countMessages()
    {
        return $this->jsonResponse['message-count'];
    }
}