<?php


namespace App\Service\Parser;


class CsvParserService implements ParserServiceInterface
{
    /**
     * @var array
     */
    private $header;

    public function parseHeader($header): array
    {
        $this->header = str_getcsv(preg_replace("/\s/", "_", $header), ";");

        return $this->header;
    }

    public function parse($record): array
    {
        $tmp = str_getcsv($record, ";");

        $result = [];

        foreach($this->header as $key => $value) {
            $result[$value] = $tmp[$key];
        }

        return $result;
    }

    public function parseFile($content): array
    {
        return str_getcsv($content, "\n");
    }

}