<?php

namespace Advent\Service\Bingo;

class BingoBoard
{
    private array $numbers = [];
    private array $selectedNumbers = [];
    private int $selectedNumbersCount = 0;

    private bool $isWin = false;
    private ?int $lastNumber = null;

    public function __construct(array $input)
    {
        foreach ($input as $string) {
            $numbers = explode (' ', $string);
            foreach ($numbers as $num) {
                if ($num === '') {
                    continue;
                }
                $this->numbers[] = (int) $num;
                $this->selectedNumbers[] = 0;
            }
        }
    }

    public function hasNumber(int $search): bool
    {
        return in_array($search, $this->numbers);
    }

    protected function numberIndex(int $number): int
    {
        return array_search($number, $this->numbers);
    }

    public function selectNumber(int $number): bool
    {
        if ($this->hasNumber($number) && !$this->isWin) {
            $this->selectedNumbers[$this->numberIndex($number)] = 1;
            $this->selectedNumbersCount++;

            $this->lastNumber = $number;

            return true;
        }

        return false;
    }

    public function isWinning(): bool
    {
        if ($this->isWin) {
            return true;
        }

        for ($i = 0; $i < 5; $i++) {
            $winCol = $this->selectedNumbers[$i] === 1 &&
                $this->selectedNumbers[$i + 5] === 1 &&
                $this->selectedNumbers[$i + 10] === 1 &&
                $this->selectedNumbers[$i + 15] === 1 &&
                $this->selectedNumbers[$i + 20] === 1;

            $lineIdx = $i * 5;
            $winLine = $this->selectedNumbers[$lineIdx] === 1 &&
                $this->selectedNumbers[$lineIdx + 1] === 1 &&
                $this->selectedNumbers[$lineIdx + 2] === 1 &&
                $this->selectedNumbers[$lineIdx + 3] === 1 &&
                $this->selectedNumbers[$lineIdx + 4] === 1;

            if ($winCol || $winLine) {
                $this->isWin = true;

                return true;
            }
        }
        return false;
    }

    public function boardScore(): int
    {
        $sum = 0;
        foreach ($this->selectedNumbers as $idx => $selectedNumber) {
            if ($selectedNumber === 0) {
                $sum += $this->numbers[$idx];
            }
        }

        return $sum * $this->lastNumber;
    }
}