<?php

namespace Advent\Service\Bingo;

class BingoGameFactory
{
    private BingoBoardFactory $bingoBoardFactory;

    public function __construct(BingoBoardFactory $bingoBoardFactory)
    {
        $this->bingoBoardFactory = $bingoBoardFactory;
    }

    public function create(array $input): BingoGameService
    {
        return new BingoGameService($input, $this->bingoBoardFactory);
    }
}