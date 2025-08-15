<?php

namespace Vanqard\Common\Locksmith\Exceptions;

use InvalidArgumentException;

class AuthenticationFailedException extends InvalidArgumentException
{
    /**
     * The identifier of the account that failed authentication. Typically this will be an email address
     *
     * @var string|null
     */
    private ?string $identifier = null;

    public function setIdentifier(string $identifier): void
    {
        $this->identifier = $identifier;
    }

    public function getIdentifier(): string
    {
        return $this->identifier;
    }
}
