<?php

declare(strict_types=1);

namespace App\Entity;

use App\Enum\Network;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;

#[Entity]
class SystemFundsDepositOperation extends BlockchainOperation
{
    public function __construct(
        Network $network,
        string $id,
        string $amount,
        #[Column]
        public readonly string $depositAddress
    ) {
        parent::__construct($network, $id, $amount);
    }


}