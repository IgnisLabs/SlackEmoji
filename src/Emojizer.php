<?php

namespace IgnisLabs\SlackEmoji;

use IgnisLabs\SlackEmoji\Emojizer\Renderer;

class Emojizer
{
    private $help = [
        'flipTable' => 'Flip a table! Three extra levels of rage: !, !!, and !!!+',
        'disapprove' => 'Let someone know you disapprove what you just read',
        'lennyFace' => 'Lenny face is lenny face',
        'lookConcerned' => 'Emphasize your preocupation. Two extra levels of concern: ! and !!+',
        'YUNO' => 'Yo don\'t just disapprove, you can\'t tolerate it!',
        'help' => 'This!',
    ];

    /**
     * @var Renderer
     */
    private $renderer;

    public function __construct(Renderer $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * Parse message and extract the command and the clean message
     * @param string $input
     * @return array [command, message]
     */
    public function parseInput($input)
    {
        $input = explode(':', $input, 2);
        $command = $input[0];

        if (!array_key_exists($command, $this->getHelp())) {
            throw new \DomainException("Invalid command [$command]. Try `/emojize help`.");
        }

        if ($command === 'help') {
            return [$command, null];
        }

        if (count($input) === 1) {
            throw new \DomainException("NEED MOAR MESSAGE.");
        }

        return [$command, trim($input[1])];
    }

    public function disapprove($msg)
    {
        return $this->renderer->render('ಠ_ಠ', $msg);
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

        return $this->renderer->render($flippings[$bangs], $msg);
    }

    public function lennyFace($msg)
    {
        return $this->renderer->render('( ͡° ͜ʖ ͡°)', $msg);
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

        return $this->renderer->render($faces[$bangs], $msg);
    }

    public function YUNO($msg)
    {
        return $this->renderer->render('ლ(ಠ益ಠლ)', $msg);
    }

    public function help($message = 'Usage: `/emojize [emoji name]: [your messaeg]`')
    {
        return $this->renderer->renderHelp($this->getHelp(), $message);
    }

    /**
     * @return array
     */
    public function getHelp()
    {
        return $this->help;
    }
}
