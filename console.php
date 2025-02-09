#!/usr/bin/env php
<?php

require __DIR__ . '/vendor/autoload.php';

// Manually bootstrap Laravel
require __DIR__ . '/bootstrap/app.php';


// The Laravel container should be bootstrapped now, so you can use facades.
use Symfony\Component\Console\Application;
use App\SymfonyConsole\AddAuthorCommand;

// Resolve the AddAuthorCommand from Laravel's container
$command = app()->make(AddAuthorCommand::class);

$application = new Application();
$application->add($command);
$application->run();