<?php

declare(strict_types=1);

namespace App\Application\Service\ViewModel\Token\View;

use App\Application\Constants;
use App\Application\Service\ViewModel\ViewInterface;

final class ClientCredentialsModel implements ViewInterface
{
    private string $accessToken;
    private int $expires;

    public function __construct(string $accessToken, int $expires)
    {
        $this->accessToken = $accessToken;
        $this->expires = $expires;
    }

    /**
     * @return array<string, string|int>
     */
    public function jsonSerialize(): array
    {
        return [
            "access_token" => $this->accessToken,
            "token_type" => Constants::TOKEN_TYPE,
            "expires_in" => $this->expires,
        ];
    }
}
