<?php

namespace Advent\Tests\Service\Bingo;

use Advent\Service\Bingo\BingoService;
use Advent\Service\FileReader;
use PHPUnit\Framework\TestCase;

class BingoServiceTest extends TestCase
{
    public function testBingoServiceIsWorking()
    {
        $fileReader = new FileReader();

        $data = $fileReader->readFile(__DIR__ . '/../../data/bingo.txt');
        $bingoService = new BingoService($data);

        $result = $bingoService->playGame();

        $this->assertEquals(4512, $result);
    }
}