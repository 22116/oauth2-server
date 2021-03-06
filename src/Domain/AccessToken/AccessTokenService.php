<?php

declare(strict_types=1);

namespace App\Domain\AccessToken;

use App\Domain\AccessToken\Contract\CryptographyInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Throwable;

class AccessTokenService
{
    private CryptographyInterface $cryptography;
    private SerializerInterface $serializer;

    public function __construct(CryptographyInterface $cryptography, SerializerInterface $serializer)
    {
        $this->cryptography = $cryptography;
        $this->serializer = $serializer;
    }

    public function encode(Payload $payload): string
    {
        return $this->cryptography->encode((array) $payload);
    }

    public function decode(string $token): ?Payload
    {
        try {
            /** @var Payload $payload */
            $payload = $this->serializer->deserialize(
                json_encode($this->cryptography->decode($token)),
                Payload::class,
                'json',
            );

            return $payload;
        } catch (Throwable $exception) {
            return null;
        }
    }
}
