<?php

namespace Advent\Command;

use Advent\Service\Bingo\BingoService;
use Advent\Service\FileReader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Day4Command extends Command
{
    private FileReader $fileReader;

    public function __construct(
        FileReader $fileReader
    ) {
        parent::__construct('day:4');
        $this->fileReader = $fileReader;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $path = __DIR__ . '/../../data/day4.1.txt';
        $data = $this->fileReader->readFile($path);

        $bingoService = new BingoService($data);
        $result = $bingoService->playGame();

        $output->writeln("First part:");
        $output->writeln("Bingo game result score: " . $result);

        return Command::SUCCESS;
    }
}