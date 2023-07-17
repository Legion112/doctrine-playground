<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;

#[Entity]
class Expense extends BaseOperation
{
    public function __construct(
        #[Column(type: 'string')]
        public readonly string $name,
        string $id,
        string $amount,
    ) {
        parent::__construct($id, $amount);
    }
}