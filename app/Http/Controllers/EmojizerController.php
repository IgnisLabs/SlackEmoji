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

    public function emojize(Emojizer $emojize, Request $request)
    {
        $command = $request->get('command');
        $emojized = $emojize->disapprove($request->get('message'));

        if (!$this->sendToSlack($command, $request->get('channel'), $emojized)) {
            abort(500, "Command [$command] not recognized");
        }

        return response(['text' => $emojized], '200')
            ->header('Content-type', 'application/json');
    }

    private function sendToSlack($command, $channel, $message)
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

        return $this->sender->send(new W\Message($message, '#'.$channel));
    }
}
