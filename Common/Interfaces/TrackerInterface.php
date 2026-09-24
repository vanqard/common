<?php

namespace Vanqard\Common\Interfaces;

use Throwable;

interface TrackerInterface
{
    public function notify(Throwable $exception, array $context = []): void;
}
