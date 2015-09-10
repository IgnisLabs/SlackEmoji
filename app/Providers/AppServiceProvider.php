<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client as GuzzleClient;
use IgnisLabs\SlackEmoji\Slack\Webhook\Sender as WebhookSender;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(WebhookSender::class, function() {
            $handler = new \GuzzleHttp\Handler\CurlHandler;
            $stack = \GuzzleHttp\HandlerStack::create($handler);

            $stack->push(\GuzzleHttp\Middleware::mapRequest(function(\Psr\Http\Message\RequestInterface $req) {
                // dd($req->getHeader('Content-Type'), (string) $req->getBody());
                return $req;
            }));

            return new WebhookSender(
                getenv('SLACK_WEBHOOK_TOKEN'),
                new GuzzleClient(['handler' => $stack])
            );
        });
    }
}
