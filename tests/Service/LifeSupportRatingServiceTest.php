<?php

namespace Advent\Tests\Service;

use Advent\Dto\LifeSupportRating;
use Advent\Service\BitSelector;
use PHPUnit\Framework\TestCase;
use Advent\Service\LifeSupportRatingService;

class LifeSupportRatingServiceTest extends TestCase
{
    private LifeSupportRatingService $lifeSupportRating;

    public function setUp(): void
    {
        $bitSelector = new BitSelector();
        $this->lifeSupportRating = new LifeSupportRatingService($bitSelector);
    }

    /**
     * @dataProvider ratingProvider
     */
    public function testGetRating(
        array $input,
        string $expectedOxygen,
        string $expectedCo2,
        int $expOxyDec,
        int $expCo2Dec,
        int $expLifeSupportRating
    ): void {
        $result = $this->lifeSupportRating->getRatings($input);

        $this->assertInstanceOf(LifeSupportRating::class, $result);

        $this->assertEquals($expectedOxygen, $result->getOxygen());
        $this->assertEquals($expectedCo2, $result->getCo2());

        $this->assertEquals($expOxyDec, $result->getOxygenDec());
        $this->assertEquals($expCo2Dec, $result->getCo2Dec());

        $this->assertEquals($expLifeSupportRating, $result->getRating());
    }

    public function ratingProvider(): array
    {
        return [
            [
                ['00100', '11110', '10110', '10111', '10101', '01111', '00111', '11100', '10000', '11001', '00010', '01010',],
                '10111',
                '01010',
                23,
                10,
                230,
            ]
        ];
    }
}