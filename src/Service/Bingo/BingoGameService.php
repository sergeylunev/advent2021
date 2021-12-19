<?php

namespace Advent\Service\Bingo;

class BingoGameService
{
    /**
     * @var BingoBoard[]
     */
    private array $boards = [];
    private bool $hasWinningBoard = false;
    private ?BingoBoard $winningBoard = null;

    public function __construct(array $input)
    {
        $count = 0;
        $boardRows = [];
        foreach ($input as $idx => $row) {
            $boardRows[] = $row;

            if ($count === 4) {
                $count = 0;
                $this->boards[] = new BingoBoard($boardRows);
                $boardRows = [];

                continue;
            }

            $count++;
        }
    }

    public function getBoardsNumber(): int
    {
        return count($this->boards);
    }

    public function checkNumber(int $number): void
    {
        if ($this->hasWinningBoard()) {
            return;
        }

        foreach ($this->boards as $board) {
            $board->selectNumber($number);
            if ($board->isWinning()) {
                $this->hasWinningBoard = true;
                $this->winningBoard = $board;

                return;
            }
        }
    }

    public function hasWinningBoard(): bool
    {
        return $this->hasWinningBoard;
    }

    public function getWinningBoardScore(): int
    {
        return $this->winningBoard->boardScore();
    }
}