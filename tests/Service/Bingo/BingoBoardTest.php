<?php

namespace Advent\Tests\Service\Bingo;

use Advent\Service\Bingo\BingoBoard;
use PHPUnit\Framework\TestCase;

class BingoBoardTest extends TestCase
{
    public function testCreateBoard()
    {
        $input = [
            '22 13 17 11  0',
            ' 8  2 23  4 24',
            '21  9 14 16  7',
            ' 6 10  3 18  5',
            ' 1 12 20 15 19',
        ];

        $board = new BingoBoard($input);

        $this->assertInstanceOf(BingoBoard::class, $board);
    }

    public function testBoardHasNumber()
    {
        $input = [
            '22 13 17 11  0',
            ' 8  2 23  4 24',
            '21  9 14 16  7',
            ' 6 10  3 18  5',
            ' 1 12 20 15 19',
        ];

        $board = new BingoBoard($input);

        $this->assertTrue($board->hasNumber(22));
        $this->assertTrue($board->selectNumber(22));

        $this->assertFalse($board->hasNumber(50));
        $this->assertFalse($board->selectNumber(50));
    }

    public function testBoardCanWin()
    {
        $input = [
            '14 21 17 24  4',
            '10 16 15  9 19',
            '18  8 23 26 20',
            '22 11 13  6  5',
            ' 2  0 12  3  7',
        ];

        $numbersToSelect = [
            7, 4, 9, 5, 11, 17, 23, 2, 0, 14, 21
        ];

        $winingNumber = 24;

        $board = new BingoBoard($input);

        foreach ($numbersToSelect as $number) {
            $board->selectNumber($number);
            $this->assertFalse($board->isWinning());
        }

        $board->selectNumber($winingNumber);
        $this->assertTrue($board->isWinning());

        $this->assertEquals(4512, $board->boardScore());
    }
}