<?php

namespace Advent\Command;

use Advent\Service\FileReader;
use Advent\Service\LifeSupportRatingService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Day3Command extends Command
{
    private LifeSupportRatingService $lifeSupportRatingService;

    private FileReader $fileReader;

    public function __construct(
        LifeSupportRatingService $lifeSupportRatingService,
        FileReader $fileReader
    )
    {
        parent::__construct('day:3');
        $this->lifeSupportRatingService = $lifeSupportRatingService;
        $this->fileReader = $fileReader;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $path = __DIR__ . '/../../data/day3.2.txt';
        $data = $this->fileReader->readFile($path);

        $ratings = $this->lifeSupportRatingService->getRatings($data);

        $output->writeln("Oxygen level: {$ratings->getOxygenDec()}");
        $output->writeln("CO2 level: {$ratings->getCo2Dec()}");
        $output->writeln("Life support rating {$ratings->getRating()}");

        return Command::SUCCESS;
    }
}