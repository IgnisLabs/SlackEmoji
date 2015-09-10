<?php

namespace spec\IgnisLabs\SlackEmoji\Slack\Webhook;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MessageSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('A message');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('IgnisLabs\SlackEmoji\Slack\Webhook\Message');
    }

    function it_has_a_message()
    {
        $this->getMessage()->shouldBe('A message');

        $this->setMessage('foo');
        $this->getMessage()->shouldBe('foo');
    }

    function it_can_have_a_channel()
    {
        $this->getChannel()->shouldBe(null);

        $this->setChannel('#foo');
        $this->getChannel()->shouldBe('#foo');
    }

    function it_can_set_user_as_channel()
    {
        $this->setChannel('@foo');
        $this->getChannel()->shouldBe('@foo');
    }

    function it_will_fail_if_the_channel_is_not_valid()
    {
        $this->shouldThrow('\DomainException')->duringSetChannel('foo');
    }

    function it_can_have_a_username()
    {
        $this->getUsername()->shouldBe(null);

        $this->setUsername('Bot name');
        $this->getUsername()->shouldBe('Bot name');
    }

    function it_can_have_an_emoji_icon()
    {
        $this->getIcon()->shouldBe(null);
        $this->getIconType()->shouldBe(null);

        $this->setIcon(':foo:');
        $this->getIcon()->shouldBe(':foo:');
        $this->getIconType()->shouldBe('emoji');
    }

    function it_can_have_an_url_icon()
    {
        $this->setIcon('http://foo/bar.baz');
        $this->getIcon()->shouldBe('http://foo/bar.baz');
        $this->getIconType()->shouldBe('url');
    }

    function it_serializes_as_json_with_no_overrides()
    {
        $this->jsonSerialize()->shouldBeLike([
            'text' => 'A message',
        ]);
    }

    function it_serializes_as_json_with_all_values_set()
    {
        $this->beConstructedWith('message', '#channel', 'username', ':icon:');

        $this->jsonSerialize()->shouldBeLike([
            'text' => 'message',
            'channel' => '#channel',
            'username' => 'username',
            'icon_emoji' => ':icon:',
        ]);
    }
}
