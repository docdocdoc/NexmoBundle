<?php

namespace DocDocDoc\NexmoBundle\Tests\Provider;

use DocDocDoc\NexmoBundle\Tests\TestCase;
use DocDocDoc\NexmoBundle\Provider\Sms;
use DocDocDoc\NexmoBundle\Message;

class SmsTest extends TestCase
{
    public function setUp()
    {
        $this->smsProvider = new Sms("https://rest.nexmo.com", "000", "000");
    }

    /**
     * @expectedException DocDocDoc\NexmoBundle\Exception\NexmoException
     */
    public function testSendSimpleMessage()
    {
        $message = new Message\Simple("A test name", "0612345678", "Hello nexmo");
        $this->smsProvider->send($message);
    }
}