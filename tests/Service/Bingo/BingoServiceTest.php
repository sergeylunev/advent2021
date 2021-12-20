<?php

namespace Advent\Tests\Service\Bingo;

use Advent\Service\Bingo\BingoBoardFactory;
use Advent\Service\Bingo\BingoGameFactory;
use Advent\Service\Bingo\BingoService;
use Advent\Service\FileReader;
use PHPUnit\Framework\TestCase;

class BingoServiceTest extends TestCase
{
    public function testBingoServiceIsWorking()
    {
        $fileReader = new FileReader();
        $bingoBoardFactory = new BingoBoardFactory();
        $bingoGameFactory = new BingoGameFactory($bingoBoardFactory);

        $data = $fileReader->readFile(__DIR__ . '/../../data/bingo.txt');
        $bingoService = new BingoService($data, $bingoGameFactory);

        $result = $bingoService->playGame();

        $this->assertEquals(4512, $result);
    }
}