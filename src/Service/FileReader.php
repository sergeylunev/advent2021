<?php

namespace Advent\Service;

class FileReader
{
    /**
     * @param string $filePath
     *
     * @throws \Exception
     * @return array
     */
    public function readFile(string $filePath): array
    {
        if (!file_exists($filePath)) {
            throw new \Exception('No such file' . $filePath);
        }

        return file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    }
}