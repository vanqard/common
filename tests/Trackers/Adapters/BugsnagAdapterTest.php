<?php

namespace Vanqard\Common\Tests\Trackers\Adapters;

use Bugsnag\Client;
use Bugsnag\Report;
use Exception;
use PHPUnit\Framework\TestCase;
use Vanqard\Common\Trackers\Adapters\BugsnagAdapter;

class BugsnagAdapterTest extends TestCase
{
    public function testNotifyDelegatesToBugsnagClientWithMetadata(): void
    {
        $exception = new Exception('boom');
        $context = ['user_id' => 42];

        $client = $this->createMock(Client::class);
        $client->expects($this->once())
            ->method('notifyException')
            ->with($exception, $this->isType('callable'))
            ->willReturnCallback(function ($ex, callable $callback) {
                $report = $this->createMock(Report::class);
                $report->expects($this->once())->method('setMetaData')->with(['user_id' => 42]);
                $callback($report);
            });

        (new BugsnagAdapter($client))->notify($exception, $context);
    }
}
