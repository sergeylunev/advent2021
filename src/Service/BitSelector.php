<?php

namespace Advent\Service;

class BitSelector
{
    public const MOST_COMMON = 1;
    public const LESS_COMMON = 2;

    public function bitByCommonality(array $input, int $bitPosition, int $type): int
    {
        $bits = [
            0 => 0,
            1 => 0,
        ];

        foreach ($input as $value) {
            $bits[$value[$bitPosition - 1]]++;
        }

        $function = $type === self::MOST_COMMON ? 'max' : 'min';

        if ($type === self::MOST_COMMON && $bits[1] === $bits[0]) {
            return 1;
        } elseif ($type === self::LESS_COMMON && $bits[0] === $bits[1]) {
            return 0;
        }

        return (int) array_search($function($bits), $bits);
    }

    public function filterBitArray(array $input, int $bitPosition, int $bitValue): array
    {
        return array_values(array_filter($input, function ($value) use ($bitPosition, $bitValue) {
            return (int) $value[$bitPosition - 1] === $bitValue;
        }));
    }
}