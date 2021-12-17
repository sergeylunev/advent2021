<?php

namespace Advent\Tests\Service;

use Advent\Service\FileReader;
use PHPUnit\Framework\TestCase;

class FileReaderTest extends TestCase
{
    private FileReader $fileReader;

    public function setUp(): void
    {
        $this->fileReader = new FileReader();
    }

    public function testCorrectlyOpensFile()
    {
        $path = __DIR__ . '/../data/test.txt';

        $result = $this->fileReader->readFile($path);
        $this->assertEquals(
            [
                '00100',
                '11110',
                '10110',
                '10111',
                '10101',
                '01111',
                '00111',
                '11100',
                '10000',
                '11001',
                '00010',
                '01010',
            ],
            $result
        );
    }
}