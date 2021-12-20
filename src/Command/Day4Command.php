<?php

namespace Advent\Command;

use Advent\Service\Bingo\BingoGameFactory;
use Advent\Service\Bingo\BingoService;
use Advent\Service\FileReader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Day4Command extends Command
{
    private FileReader $fileReader;
    private BingoGameFactory $bingoGameFactory;

    public function __construct(
        FileReader $fileReader,
        BingoGameFactory $bingoGameFactory
    ) {
        parent::__construct('day:4');
        $this->fileReader = $fileReader;
        $this->bingoGameFactory = $bingoGameFactory;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $path = __DIR__ . '/../../data/day4.txt';
        $data = $this->fileReader->readFile($path);

        $bingoService = new BingoService($data, $this->bingoGameFactory);
        $result = $bingoService->getFirstWinningBoard();
        $lastResult = $bingoService->getLastWinningBoard();

        $output->writeln("First part:");
        $output->writeln("Bingo game result score: " . $result);

        $output->writeln("Second part:");
        $output->writeln("Bingo game last result score: " . $lastResult);

        return Command::SUCCESS;
    }
}