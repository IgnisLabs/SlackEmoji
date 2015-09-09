<?php

namespace spec\IgnisLabs\SlackEmoji;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EmojizerSpec extends ObjectBehavior
{
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

    function it_puts_a_lenny_face()
    {
        $this->lennyFace('lorem ipsum')->shouldReturn('( ͡° ͜ʖ ͡°) lorem ipsum');
    }

    function it_looks_concerned()
    {
        $this->lookConcerned('lorem ipsum')->shouldReturn('ಠ~ಠ lorem ipsum');
        $this->lookConcerned('lorem ipsum!')->shouldReturn('ಥ~ಥ lorem ipsum!');
        $this->lookConcerned('lorem ipsum!!')->shouldReturn('ಥ益ಥ lorem ipsum!!');
        $this->lookConcerned('lorem ipsum!!!')->shouldReturn('ಥ益ಥ lorem ipsum!!!');
    }

    function it_Y_U_NO()
    {
        $this->YUNO('lorem ipsum')->shouldReturn('ლ(ಠ益ಠლ) lorem ipsum');
    }
}
