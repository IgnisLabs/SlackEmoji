<?php

namespace App\Http\Controllers;

use IgnisLabs\SlackEmoji\Emojizer;
use Illuminate\Http\Request;
use IgnisLabs\SlackEmoji\Slack\Webhook as W;

class EmojizerController extends Controller
{
    private $sender;

    public function __construct(W\Sender $sender)
    {
        $this->middleware('slack-token-auth');
        $this->sender = $sender;
    }

    public function emojize(Emojizer $emojizer, Request $request)
    {
        $message = $request->get('text');
        $command = $request->get('command');
        $channel = $request->get('channel_name');
        $username = $request->get('user_name');

        $emojized = $this->emojizeMessage($command, $message, $emojizer);

        try {
            if (!$this->sender->send(new W\Message($emojized, '#'.$channel, $username))) {
                abort(500, "Command [$command] not recognized");
            }
        } catch (\Exception $ex) {
            abort(500, $ex->getMessage());
        }

        return '';
    }

    /**
     * @param $command
     * @param string $message
     * @param Emojizer $emojize
     * @return string
     */
    private function emojizeMessage($command, $message, Emojizer $emojize)
    {
        $commands = [
            '/tableflip' => 'flipTable',
            '/disapproval' => 'dissaprove',
            '/lenny' => 'lennyFace',
            '/concerned' => 'lookConcerned',
            '/YUNO' => 'YUNO',
        ];

        if (!array_key_exists($command, $commands)) {
            return false;
        }

        return $emojize->$commands[$command]($message);
    }
}
