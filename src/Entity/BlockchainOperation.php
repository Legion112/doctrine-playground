<?php

declare(strict_types=1);

namespace App\Entity;

use App\Enum\Network;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;

#[Entity]
abstract class BlockchainOperation extends BaseOperation
{
    public function __construct(
        #[Column] public readonly Network $network,
        string $id,
        string $amount
    )
    {
        parent::__construct($id, $amount);
    }
}