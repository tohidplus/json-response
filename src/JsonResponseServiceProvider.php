<?php


namespace Tohidplus\JsonResponse;

use Illuminate\Support\ServiceProvider;

class JsonResponseServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(Response::class, function ($app, $params) {
            return new Response(
                new Component(
                    new Input($params["result"]["data"] ?? null),
                    new Input($params["result"]["meta"] ?? null),
                ),
                new Component(
                    new Input($params["error"]["data"] ?? null),
                    new Input($params["error"]["meta"] ?? null),
                ),
                $params["status"] ?? "success",
                $params["status_code"] ?? 200
            );
        });
        $this->app->bind('tohidplus-json-response', function () {
            return new ResponseGenerator();
        });
    }
}
