<?php

namespace Vanqard\Common\Trackers\Adapters;

use Sentry\State\HubInterface;
use Sentry\State\Scope;
use Throwable;
use Vanqard\Common\Interfaces\TrackerInterface;

class SentryAdapter implements TrackerInterface
{
    private HubInterface $hub;

    public function __construct(HubInterface $hub)
    {
        $this->hub = $hub;
    }

    public function notify(Throwable $exception, array $context = []): void
    {
        $this->hub->withScope(function (Scope $scope) use ($exception, $context) {
            foreach ($context as $key => $value) {
                $scope->setExtra((string) $key, $value);
            }

            $this->hub->captureException($exception);
        });
    }
}
