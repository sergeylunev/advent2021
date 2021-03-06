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
    private ?BingoBoard $lastWinningBoard = null;
    private BingoBoardFactory $bingoBoardFactory;

    public function __construct(
        array $input,
        BingoBoardFactory $bingoBoardFactory
    ) {
        $this->bingoBoardFactory = $bingoBoardFactory;

        $count = 0;
        $boardRows = [];
        foreach ($input as $idx => $row) {
            $boardRows[] = $row;

            if ($count === 4) {
                $count = 0;
                $this->boards[] = $bingoBoardFactory->create($boardRows);
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
        foreach ($this->boards as $board) {
            if ($board->isWinning()) {
                continue;
            }

            $board->selectNumber($number);
            if ($board->isWinning()) {
                $this->hasWinningBoard = true;
                $this->winningBoard = $board;
                $this->lastWinningBoard = $board;
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

    public function getLastWinningBoardScore(): int
    {
        return $this->lastWinningBoard->boardScore();
    }

    public function getLastWinningBoard(): BingoBoard
    {
        return $this->lastWinningBoard;
    }
}