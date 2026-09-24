<?php

namespace Vanqard\Common\Trackers\Adapters;

use Bugsnag\Client;
use Bugsnag\Report;
use Throwable;
use Vanqard\Common\Interfaces\TrackerInterface;

class BugsnagAdapter implements TrackerInterface
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function notify(Throwable $exception, array $context = []): void
    {
        $this->client->notifyException($exception, function (Report $report) use ($context) {
            $report->setMetaData($context);
        });
    }
}
