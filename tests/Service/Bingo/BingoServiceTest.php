<?php

namespace Advent\Tests\Service\Bingo;

use Advent\Service\Bingo\BingoGameService;
use PHPUnit\Framework\TestCase;

class BingoServiceTest extends TestCase
{
    public function testBoardCreation(): void
    {
        $input = [
            '22 13 17 11  0',
            ' 8  2 23  4 24',
            '21  9 14 16  7',
            ' 6 10  3 18  5',
            ' 1 12 20 15 19',
            ' 3 15  0  2 22',
            ' 9 18 13 17  5',
            '19  8  7 25 23',
            '20 11 10 24  4',
            '14 21 16 12  6',
            '14 21 17 24  4',
            '10 16 15  9 19',
            '18  8 23 26 20',
            '22 11 13  6  5',
            ' 2  0 12  3  7',
        ];

        $bingoGameService = new BingoGameService($input);

        $this->assertInstanceOf(BingoGameService::class, $bingoGameService);
        $this->assertEquals(
            3,
            $bingoGameService->getBoardsNumber()
        );
    }
}