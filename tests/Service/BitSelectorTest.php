<?php

namespace Advent\Tests\Service;

use Advent\Service\BitSelector;
use PHPUnit\Framework\TestCase;

class BitSelectorTest extends TestCase
{
    private BitSelector $bitSelector;

    public function setUp(): void
    {
        $this->bitSelector = new BitSelector();
    }

    /**
     * @dataProvider mostCommonBits
     */
    public function testSelectingBits(
        array $bits,
        int $position,
        int $expected,
        int $bitType
    ): void {
        $result = $this->bitSelector->bitByCommonality(
            $bits,
            $position,
            $bitType
        );

        $this->assertEquals($expected, $result);
    }

    public function mostCommonBits(): array
    {
        return [
            [
                ['00100', '11110', '10110', '10111', '10101', '01111', '00111', '11100', '10000', '11001', '00010', '01010',],
                1,
                1,
                BitSelector::MOST_COMMON,
            ],
            [
                ['11110', '10110', '10111', '10101', '11100', '10000', '11001'],
                2,
                0,
                BitSelector::MOST_COMMON,
            ],
            [
                ['10110', '10111'],
                5,
                1,
                BitSelector::MOST_COMMON,
            ],
            [
                ['00100', '11110', '10110', '10111', '10101', '01111', '00111', '11100', '10000', '11001', '00010', '01010',],
                1,
                0,
                BitSelector::LESS_COMMON,
            ],
            [
                ['00100', '01111', '00111', '00010', '01010',],
                2,
                1,
                BitSelector::LESS_COMMON,
            ],
            [
                ['01111', '01010'],
                3,
                0,
                BitSelector::LESS_COMMON,
            ],
        ];
    }

    /**
     * @dataProvider filteringBitArray
     */
    public function testFilteringBitArray(
        array $input,
        int $position,
        int $bit,
        array $expected
    )
    {
        $result = $this->bitSelector->filterBitArray(
            $input,
            $position,
            $bit
        );

        $this->assertEquals($expected, $result);
    }

    public function filteringBitArray(): array
    {
        return [
            [
                ['00100', '11110', '10110', '10111', '10101', '01111', '00111', '11100', '10000', '11001', '00010', '01010',],
                1,
                1,
                ['11110', '10110', '10111', '10101', '11100', '10000', '11001'],
            ]
        ];
    }
}