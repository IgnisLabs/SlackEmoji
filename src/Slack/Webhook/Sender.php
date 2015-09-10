<?php

namespace IgnisLabs\SlackEmoji\Slack\Webhook;

use GuzzleHttp\ClientInterface;
use IgnisLabs\SlackEmoji\Slack\Webhook\Message;

class Sender
{
    private $baseUrl = 'https://hooks.slack.com/services/';

    public function __construct($token, ClientInterface $client)
    {
        $this->token = $token;
        $this->client = $client;
    }

    public function send(Message $message)
    {
        return $this->client->post($this->getUrl(), [
            'json' => ['text' => $message],
        ]);
    }

    private function getUrl()
    {
        return $this->baseUrl . $this->token;
    }
}
