<?php

namespace DocDocDoc\NexmoBundle\Exception;

class NexmoException extends \RuntimeException
{
    public function __construct($status, $errorText)
    {
        return parent::__construct($errorText, $status);
    }
}