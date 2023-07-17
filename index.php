<?php

declare(strict_types=1);

/** @var \Doctrine\ORM\EntityManagerInterface $em */
['em' => $em] = require __DIR__ . '/bootstrap.php';

use App\Entity\Expense;
use App\Entity\SystemFundsDepositOperation;
use App\Enum\Network;


$em->persist(
    $expense = new Expense(
        'Network commission',
        'B6806E3B-B369-4167-9F3E-5A62492636A7',
        '0.001'
    )
);

$em->persist(
    $blokchain = new SystemFundsDepositOperation(
        Network::ETHEREUM,
        '0DAB1B68-0E82-40B6-99F2-B800EF14C6D6',
        '0.1101',
        'aaaaabababdssfasdfafdsafdfsa'
    )
);

$em->flush();
$em->clear();

// Fetch from repositories

$operationRepository = new App\Repository\OperationRepository($em);
//$operationRepository = new App\Repository\BlockchainRepository($em);
//$operationRepository->findBy(['network' => Network::ETHEREUM]);
$operations = $operationRepository->findAll();
foreach ($operations as $operation) {
    var_dump($operation);
}


