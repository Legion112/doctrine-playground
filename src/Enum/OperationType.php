<?php

declare(strict_types=1);

namespace App\Enum;

enum OperationType:string
{
    case BLOCKCHAIN_IN = 'blockchain-in';
    case EXPENSE = 'expense';
}