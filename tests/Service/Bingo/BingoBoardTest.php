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
        $this->assertFalse($board->hasNumber(50));
    }
}