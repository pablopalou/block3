#! /usr/bin/env php

<?php

use Acme\SayHelloCommand;
use Symfony\Component\Console\Application;
use GuzzleHttp\Client;

require 'vendor/autoload.php';

$app = new Application();

$app->add(new SayHelloCommand);
$app->add(new Acme\RenderCommand);

$app->run();

#se corre desde la terminal con:

# ./index.php render scarface
