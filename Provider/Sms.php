<?php

namespace DocDocDoc\NexmoBundle\Provider;

use DocDocDoc\NexmoBundle\Message\MessageInterface;
use DocDocDoc\NexmoBundle\Exception\NexmoException;
use DocDocDoc\NexmoBundle\Response\NexmoResponse;

class Sms implements ProviderInterface
{
    private $nexmo_base_url;
    const SMS_ENDPOINT = '/sms/json';
    const STATUS_SUCCESS = 0;

    private $api_key;
    private $api_secret;

    public function __construct($nexmo_base_url, $api_key, $api_secret)
    {
        $this->nexmo_base_url = $nexmo_base_url;
        $this->api_key = $api_key;
        $this->api_secret = $api_secret;
    }

    public function send(MessageInterface $message)
    {
        $client = new \GuzzleHttp\Client();

        $params = $message->toRequest();
        $params['api_key']    = $this->api_key;
        $params['api_secret'] = $this->api_secret;
        try {
            $postBody = [];

            foreach ($params as $key => $value) {
                $postBody[$key] = $value;
            }
            
            $response = $client->request('POST', $this->nexmo_base_url.self::SMS_ENDPOINT, [
                'form_params' => $postBody
            ]);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
        }

        $json = json_decode($response->getBody(), true);

        if ($json['messages'][0]['status'] != self::STATUS_SUCCESS) {
            throw new NexmoException($json['messages'][0]['status'], $json['messages'][0]['error-text']);
        }

        return new NexmoResponse($json);
    }
}
