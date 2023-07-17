<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\OperationRepository;
use Doctrine\ORM\Mapping\ChangeTrackingPolicy;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\DiscriminatorMap;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\InheritanceType;
use Doctrine\ORM\Mapping\Table;


#[Entity(repositoryClass: OperationRepository::class)]
#[ChangeTrackingPolicy(value: 'DEFERRED_EXPLICIT')]
#[Table(name: 'operations')]
#[InheritanceType(value: 'SINGLE_TABLE')]
#[DiscriminatorColumn(name: 'type', type: 'string')]
#[DiscriminatorMap([
    'blockchain-in' =>  SystemFundsDepositOperation::class,
    'expense' =>  Expense::class,
])]
abstract class BaseOperation
{


    public function __construct(
        #[Id]
        #[Column(type: 'guid')]
        public readonly string $id,
        #[Column(type: 'string')]
        public readonly string $amount,
    )
    {
    }
}