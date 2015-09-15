<?php

namespace spec\IgnisLabs\SlackEmoji\Emojizer;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DefaultRendererSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('IgnisLabs\SlackEmoji\Emojizer\DefaultRenderer');
    }

    function it_renders_a_message()
    {
        $this->render('emoji', 'message')->shouldBe('emoji message');
    }

    function it_renders_a_help_message()
    {
        $this->renderHelp(['cmd' => 'text'], 'a help message')->shouldBe("a help message\ncmd: text");
    }
}
