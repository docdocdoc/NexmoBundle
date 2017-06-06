<?php

namespace DocDocDoc\NexmoBundle\Message;

class Unicode extends Simple
{
    public $form;
    public $to;
    public $text;

    /**
     * @param string $from the sender id (truncated to 11 chars)
     * @param string $to   the phone number to send it
     * @param string $text the message body
     */
    public function __construct($from, $to, $text)
    {
        $this->from = $from;
        $this->to   = $to;
        $this->text = $text;
    }

    public function toRequest()
    {
        return [
            'from' => $this->from,
            'to'   => $this->to,
            'text' => $this->text,
            'type' => 'unicode'
        ];
    }
}
