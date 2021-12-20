<?php

namespace Advent\Service\Bingo;

class BingoBoardFactory
{
    public function create(array $input): BingoBoard
    {
        return new BingoBoard($input);
    }
}