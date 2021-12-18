<?php

namespace Advent\Service\Bingo;

class BingoBoard
{
    private array $numbers;

    public function __construct(array $input)
    {
        $result = [];

        foreach ($input as $string) {
            $numbers = explode (' ', $string);
            foreach ($numbers as $num) {
                if ($num === '') {
                    continue;
                }
                $result[] = (int) $num;
            }
        }

        $this->numbers = $result;
    }

    public function hasNumber(int $search): bool
    {
        return in_array($search, $this->numbers);
    }
}