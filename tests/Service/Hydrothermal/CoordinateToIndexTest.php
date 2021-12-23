<?php

namespace Advent\Tests\Service\Hydrothermal;

use Advent\Service\Hydrothermal\CoordinateToIndex;
use PHPUnit\Framework\TestCase;

class CoordinateToIndexTest extends TestCase
{
    private CoordinateToIndex $coordinateToIndex;

    public function setUp(): void
    {
        $gridLength = 4;
        $this->coordinateToIndex = new CoordinateToIndex($gridLength);
    }

    public function testConvertCoordinatesToIndex()
    {
        $expected = [5, 9, 13];
        $result = $this->coordinateToIndex->convert('1,1', '1,3');

        $this->assertEquals($expected, $result);
    }
}