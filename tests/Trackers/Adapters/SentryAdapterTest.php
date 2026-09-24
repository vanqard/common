<?php

namespace Vanqard\Common\Tests\Trackers\Adapters;

use Exception;
use PHPUnit\Framework\TestCase;
use Sentry\State\HubInterface;
use Sentry\State\Scope;
use Vanqard\Common\Trackers\Adapters\SentryAdapter;

class SentryAdapterTest extends TestCase
{
    public function testNotifyDelegatesToSentryHubWithScopedContext(): void
    {
        $exception = new Exception('boom');
        $context = ['user_id' => 42];

        $scope = $this->createMock(Scope::class);
        $scope->expects($this->once())->method('setExtra')->with('user_id', 42);

        $hub = $this->createMock(HubInterface::class);
        $hub->expects($this->once())
            ->method('withScope')
            ->willReturnCallback(function (callable $callback) use ($scope) {
                return $callback($scope);
            });
        $hub->expects($this->once())
            ->method('captureException')
            ->with($exception);

        (new SentryAdapter($hub))->notify($exception, $context);
    }
}
