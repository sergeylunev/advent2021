<?php

namespace Advent\Service\Bingo;

use Advent\Service\FileReader;

class BingoService
{
    private array $numbers;
    private BingoGameService $bingoGameService;

    public function __construct(array $input)
    {
        $this->prepareData($input);
    }

    protected function prepareData(array $input)
    {
        $this->numbers = explode(',', array_shift($input));
        $this->bingoGameService = new BingoGameService($input);
    }

    public function playGame(): int
    {
        foreach ($this->numbers as $number) {
            $this->bingoGameService->checkNumber($number);
            if ($this->bingoGameService->hasWinningBoard()) {
                return $this->bingoGameService->getWinningBoardScore();
            }
        }
    }
}