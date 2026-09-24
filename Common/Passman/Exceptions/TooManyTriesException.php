<?php

namespace Vanqard\Common\Passman\Exceptions;

use Exception;
use Vanqard\Common\Interfaces\NotifiableExceptionInterface;
use Vanqard\Common\Interfaces\PublishableExceptionInterface;

class TooManyTriesException extends Exception implements NotifiableExceptionInterface, PublishableExceptionInterface
{
}
