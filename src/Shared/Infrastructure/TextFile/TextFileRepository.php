<?php
declare(strict_types=1);

namespace IOET\Acme\Shared\Infrastructure\TextFile;

ini_set("auto_detect_line_endings", "1");

abstract class TextFileRepository
{

    protected function read(string $filename): array
    {
        $data = array();
        
        $resource = fopen($filename, "r");
        while(!feof($resource))
        {
            array_push($data, fgets($resource));
        }
        fclose($resource);
        return $data;
    }
}