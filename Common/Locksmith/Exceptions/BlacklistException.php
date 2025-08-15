<?php

namespace Vanqard\Common\Locksmith\Exceptions;

use Exception;
use Vanqard\Common\Interfaces\NotifiableExceptionInterface;

class BlacklistException extends Exception implements NotifiableExceptionInterface
{
}
