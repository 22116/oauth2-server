<?php

declare(strict_types=1);

namespace App\Application\Service\Date;

use DateTime;

interface ComparatorStrategyInterface
{
    public function compare(DateTime $dateTimeA, DateTime $dateTimeB): bool;
}
