<?php

declare(strict_types=1);

namespace App\Domain\AccessToken;

class Payload
{
    public string $username;
    public int $expires;

    /** @var array<string> */
    public array $scopes;

    /**
     * @param array<string> $scopes
     */
    public function __construct(string $username, int $expires, array $scopes)
    {
        $this->username = $username;
        $this->expires = $expires;
        $this->scopes = $scopes;
    }
}
