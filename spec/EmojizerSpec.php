<?php

namespace spec\IgnisLabs\SlackEmoji;

use IgnisLabs\SlackEmoji\Emojizer\Renderer;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EmojizerSpec extends ObjectBehavior
{
    function let(Renderer $renderer)
    {
        $this->beConstructedWith($renderer);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('IgnisLabs\SlackEmoji\Emojizer');
    }

    function it_looks_with_disapproval()
    {
        $this->disapprove('lorem ipsum')->shouldReturn('ಠ_ಠ lorem ipsum');
    }

    function it_flips_tables()
    {
        $this->flipTable('lorem ipsum')->shouldReturn('(╯°□°)╯︵ ┻━━┻ lorem ipsum');
        $this->flipTable('lorem ipsum!')->shouldReturn('(╯°Д°)╯彡┻━━┻ lorem ipsum!');
        $this->flipTable('lorem ipsum!!')->shouldReturn('(ノಥ益ಥ)ノ彡┻━━┻ lorem ipsum!!');
        $this->flipTable('lorem ipsum!!!')->shouldReturn('┻━━┻ ︵ヽ(`Д´)ﾉ︵ ┻━━┻ lorem ipsum!!!');
        $this->flipTable('lorem ipsum!!!!')->shouldReturn('┻━━┻ ︵ヽ(`Д´)ﾉ︵ ┻━━┻ lorem ipsum!!!!');
    }

    function it_looks_with_disapproval(Renderer $renderer)
    {
        $renderer->render('ಠ_ಠ', 'lorem ipsum')->willReturn('foo')->shouldBeCalled();
        $this->disapprove('lorem ipsum')->shouldBe('foo');
    }

    function it_flips_tables(Renderer $renderer)
    {
        $renderer->render('(╯°□°)╯︵ ┻━━┻', 'lorem ipsum')->willReturn('foo')->shouldBeCalled();
        $renderer->render('(╯°Д°)╯彡┻━━┻', 'lorem ipsum!')->shouldBeCalled();
        $renderer->render('(ノಥ益ಥ)ノ彡┻━━┻', 'lorem ipsum!!')->shouldBeCalled();
        $renderer->render('┻━━┻ ︵ヽ(`Д´)ﾉ︵ ┻━━┻', 'lorem ipsum!!!')->shouldBeCalled();
        $renderer->render('┻━━┻ ︵ヽ(`Д´)ﾉ︵ ┻━━┻', 'lorem ipsum!!!!')->shouldBeCalled();

        $this->flipTable('lorem ipsum')->shouldBe('foo');
        $this->flipTable('lorem ipsum!');
        $this->flipTable('lorem ipsum!!');
        $this->flipTable('lorem ipsum!!!');
        $this->flipTable('lorem ipsum!!!!');
    }

    function it_puts_a_lenny_face(Renderer $renderer)
    {
        $renderer->render('( ͡° ͜ʖ ͡°)', 'lorem ipsum')->shouldBeCalled();
        $this->lennyFace('lorem ipsum');
    }

    function it_looks_concerned(Renderer $renderer)
    {
        $renderer->render('ಠ~ಠ', 'lorem ipsum')->willReturn('foo')->shouldBeCalled();
        $renderer->render('ಥ~ಥ', 'lorem ipsum!')->shouldBeCalled();
        $renderer->render('ಥ益ಥ', 'lorem ipsum!!')->shouldBeCalled();
        $renderer->render('ಥ益ಥ', 'lorem ipsum!!!')->shouldBeCalled();

        $this->lookConcerned('lorem ipsum')->shouldBe('foo');
        $this->lookConcerned('lorem ipsum!');
        $this->lookConcerned('lorem ipsum!!');
        $this->lookConcerned('lorem ipsum!!!');
    }

    function it_Y_U_NO(Renderer $renderer)
    {
        $renderer->render('ლ(ಠ益ಠლ)', 'lorem ipsum')->willReturn('foo')->shouldBeCalled();
        $this->YUNO('lorem ipsum')->shouldBe('foo');
    }

    function it_Y_U_NO()
    {
        $this->YUNO('lorem ipsum')->shouldReturn('ლ(ಠ益ಠლ) lorem ipsum');
    }
}
