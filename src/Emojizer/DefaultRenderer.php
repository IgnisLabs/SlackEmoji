<?php namespace IgnisLabs\SlackEmoji\Emojizer;

class DefaultRenderer implements Renderer
{
    /**
     * Render emoji + message
     * @param string $emoji
     * @param string $message
     * @return string
     */
    public function render($emoji, $message)
    {
        return "{$emoji} {$message}";
    }

    /**
     * Render emojizer help
     * @param array $help
     * @param string $message
     * @return string
     */
    public function renderHelp(array $help, $message = '')
    {
        $out = $message;

        foreach ($help as $cmd => $helpText) {
            $out .= PHP_EOL."{$cmd}: {$helpText}";
        }

        return $out;
    }
}
