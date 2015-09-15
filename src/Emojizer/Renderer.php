<?php namespace IgnisLabs\SlackEmoji\Emojizer;

interface Renderer
{
    /**
     * Render emoji + message
     * @param string $emoji
     * @param string $message
     * @return string
     */
    public function render($emoji, $message);

    /**
     * Render emojizer help
     * @param array $help
     * @param string $message
     * @return string
     */
    public function renderHelp(array $help, $message = '');
}
