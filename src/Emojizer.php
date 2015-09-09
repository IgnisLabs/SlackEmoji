<?php

namespace IgnisLabs\SlackEmoji;

class Emojizer
{
    public function disapprove($msg)
    {
        return $this->emojized('ಠ_ಠ', $msg);
    }

    public function flipTable($msg)
    {
        $flippings = [
            '(╯°□°)╯︵ ┻━━┻',
            '(╯°Д°)╯彡┻━━┻',
            '(ノಥ益ಥ)ノ彡┻━━┻',
            '┻━━┻ ︵ヽ(`Д´)ﾉ︵ ┻━━┻',
        ];

        $bangs = 0;
        if (preg_match('/(!{1,3})$/', $msg, $m)) {
            $bangs = strlen($m[1]);
        }

        return $this->emojized($flippings[$bangs], $msg);
    }

    public function lennyFace($msg)
    {
        return $this->emojized('( ͡° ͜ʖ ͡°)', $msg);
    }

    public function lookConcerned($msg)
    {
        $faces = [
            'ಠ~ಠ',
            'ಥ~ಥ',
            'ಥ益ಥ',
        ];

        $bangs = 0;
        if (preg_match('/(!{1,2})$/', $msg, $m)) {
            $bangs = strlen($m[1]);
        }

        return $this->emojized($faces[$bangs], $msg);
    }

    public function YUNO($msg)
    {
        return $this->emojized('ლ(ಠ益ಠლ)', $msg);
    }

    private function emojized($emoji, $msg)
    {
        return sprintf('%s %s', $emoji, $msg);
    }
}
