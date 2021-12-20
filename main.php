#!/usr/bin/env php

<?php

require __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Console\Application;

$application = new Application();

$fileReaderService = new \Advent\Service\FileReader();

$bitSelectorService = new \Advent\Service\BitSelector();
$lifeSupportRatingService = new \Advent\Service\LifeSupportRatingService(
    $bitSelectorService
);

$bingoBoardFactory = new \Advent\Service\Bingo\BingoBoardFactory();
$bingoGameFactory = new \Advent\Service\Bingo\BingoGameFactory($bingoBoardFactory);

$day3 = new \Advent\Command\Day3Command(
    $lifeSupportRatingService,
    $fileReaderService
);
$day4 = new \Advent\Command\Day4Command(
    $fileReaderService,
    $bingoGameFactory
);

$application->add($day3);
$application->add($day4);

$application->run();