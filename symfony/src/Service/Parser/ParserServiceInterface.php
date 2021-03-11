<?php


namespace App\Service\Parser;


interface ParserServiceInterface
{

    function parseHeader($header);

    function parse($record);

    function parseFile($content);
}