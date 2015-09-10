<?php

namespace spec\IgnisLabs\SlackEmoji\Slack\Webhook;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use GuzzleHttp\ClientInterface;
use IgnisLabs\SlackEmoji\Slack\Webhook\Message;

class SenderSpec extends ObjectBehavior
{
    function let(ClientInterface $client)
    {
        $this->beConstructedWith('foo/bar/baz', $client);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('IgnisLabs\SlackEmoji\Slack\Webhook\Sender');
    }
}
