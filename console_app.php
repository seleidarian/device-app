<?php
// application.php

require __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Console\Application;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Config\FileLocator;
use App\Entity\Article;

$application = new Application();

$container = new ContainerBuilder();
$loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/config'));
$loader->load('services.yaml');
$container->compile();


$article = $container->get(Article::class);



//$application->run();
