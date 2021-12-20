<?php

namespace Advent\Service\Bingo;

use Advent\Service\FileReader;

class BingoService
{
    private array $numbers;
    private BingoGameService $bingoGameService;
    private BingoGameFactory $bingoGameFactory;

    public function __construct(
        array $input,
        BingoGameFactory $bingoGameFactory
    ) {
        $this->bingoGameFactory = $bingoGameFactory;

        $this->createGame($input);
    }

    protected function createGame(array $input)
    {
        $this->numbers = explode(',', array_shift($input));
        $this->bingoGameService = $this->bingoGameFactory->create($input);
    }

    public function getFirstWinningBoard(): int
    {
        foreach ($this->numbers as $number) {
            $this->bingoGameService->checkNumber($number);
            if ($this->bingoGameService->hasWinningBoard()) {
                return $this->bingoGameService->getWinningBoardScore();
            }
        }
    }

    public function getLastWinningBoard(): int
    {
        foreach ($this->numbers as $number) {
            $this->bingoGameService->checkNumber($number);
        }

        return $this->bingoGameService->getLastWinningBoardScore();
    }
}