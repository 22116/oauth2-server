<?php declare(strict_types=1);

namespace App\Infrastructure\Service\Date;

class DateTime implements DateTimeInterface
{
    public function getDate(): \DateTime
    {
        return new \DateTime();
    }
}