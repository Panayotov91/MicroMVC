<?php

spl_autoload_register();

$uriHandler = new \Core\Http\UriHandler();
$uriHandler->processUri($_SERVER['REQUEST_URI'], $_SERVER['PHP_SELF']);

$dbInfo = parse_ini_file('Config/db.ini');
$db = new \Database\PDODatabase(new PDO($dbInfo['dsn'], $dbInfo['user'], $dbInfo['password']));

$container = new \Core\DependencyManagement\Container();

$container->cache(\Core\DependencyManagement\ContainerInterface::class, $container);
$container->cache(\Database\DatabaseInterface::class, $db);
$container->cache(\Core\Http\UriHandlerInterface::class, $uriHandler);

$container->addDependency(
    \Core\ViewEngine\ViewEngineInterface::class,
    \Core\ViewEngine\ViewEngine::class
);

$container->addDependency(
    \Core\ModelBinding\ModelBinderInterface::class,
    \Core\ModelBinding\ModelBinder::class
);

$container->addDependency(
    \Core\ApplicationInterface::class,
    \Core\Application::class
);

$container->addDependency(
    \Database\DatabaseInterface::class,
    \Database\PDODatabase::class
);

$container->addDependency(
    \Services\TestServiceInterface::class,
    \Services\TestService::class
);

$container->addDependency(
    \Services\TestService2Interface::class,
    \Services\TestService2::class
);

$app = $container->resolve(\Core\ApplicationInterface::class);

$app->start();
