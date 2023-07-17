<?php
declare(strict_types=1);

namespace App\Enum;

enum Network: string
{
    case BITCOIN = 'bitcoin';
    case ETHEREUM = 'ethereum';
}