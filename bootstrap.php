<?php

declare(strict_types=1);

require_once "vendor/autoload.php";

// bootstrap.php
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Logging\Middleware;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;
//use Doctrine\ORM\Tools\Console\Command\SchemaTool\CreateCommand as CreateTableInMemory;
use Doctrine\ORM\Tools\Console\Command\SchemaTool\UpdateCommand as CreateTableInMemory;
use Doctrine\ORM\Tools\Console\Command\SchemaTool\DropCommand as DropTable;
use Symfony\Component\Console\Input;
use Symfony\Component\Console\Logger\ConsoleLogger;
use Symfony\Component\Console\Output;

return (function () {
    $output = new Output\ConsoleOutput(Output\ConsoleOutput::VERBOSITY_DEBUG);
    $input = new Input\StringInput('');

// Create a simple "default" Doctrine ORM configuration for Attributes
    $config = ORMSetup::createAttributeMetadataConfiguration(
        paths: array(__DIR__ . "/src"),
        isDevMode: true,
    );
    $config->setMiddlewares([
        new Middleware(
            $logger = new ConsoleLogger($output)
        )
    ]);

// configuring the database connection
    $connection = DriverManager::getConnection([
        'driver' => 'pdo_sqlite',
        'path' =>  __DIR__ . '/db.sqlite',
    ], $config);


// obtaining the entity manager
    $em = new EntityManager($connection, $config);

    (new DropTable(
        new SingleManagerProvider($em),
    ))->run(new Input\StringInput('--force'), $output);
    foreach (['--force'] as $cliInput) {
        (new CreateTableInMemory(
            new SingleManagerProvider($em),
        ))->run(new Input\StringInput($cliInput), $output);
    }
    return ['em' => $em];
})();