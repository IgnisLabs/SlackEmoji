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
        if ($request->get('command') !== '/emojize') {
            abort(400, 'NOPE');
        }

        $message = $request->get('text', 'help');
        $channel = $request->get('channel_name');
        $username = $request->get('user_name');

        try {
            list($command, $message) = $emojizer->parseInput($message);

            if ($command === 'help') {
                return $emojizer->help();
            }

            $emojized = $emojizer->{$command}($message);
            $this->sender->send(new W\Message($emojized, '#'.$channel, $username));
        } catch (\Exception $ex) {
            abort(500, $ex->getMessage());
        }
    }
}
