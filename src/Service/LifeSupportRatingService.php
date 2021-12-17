<?php

namespace Advent\Service;

use Advent\Dto\LifeSupportRating;

class LifeSupportRatingService
{
    private BitSelector $bitSelector;

    public function __construct(BitSelector $bitSelector)
    {
        $this->bitSelector = $bitSelector;
    }

    public function getRatings(array $input): LifeSupportRating
    {
        $oxyData = $co2Data = $input;

        $oxygen = '';
        $co2 = '';

        $range = range(1, mb_strlen($input[0]));
        foreach ($range as $position) {
            $oxyBit = $this->bitSelector->bitByCommonality($oxyData, $position, BitSelector::MOST_COMMON);
            $co2Bit = $this->bitSelector->bitByCommonality($co2Data, $position, BitSelector::LESS_COMMON);

            $oxyData = $this->bitSelector->filterBitArray($oxyData, $position, $oxyBit);
            $co2Data = $this->bitSelector->filterBitArray($co2Data, $position, $co2Bit);

            if (count($oxyData) === 1) {
                $oxygen = $oxyData[0];
            }

            if (count($co2Data) === 1) {
                $co2 = $co2Data[0];
            }
        }

        return new LifeSupportRating($oxygen, $co2);
    }
}