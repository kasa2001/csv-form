<?php


namespace App\Service\Form\Adapter;


use App\Service\Parser\ParserServiceInterface;
use Symfony\Component\Form\FormInterface;

class CsvAdapter implements FormAdapterInterface
{

    private $parserService;

    public function __construct(ParserServiceInterface $parserService)
    {
        $this->parserService = $parserService;
    }

    public function doAdapter(FormInterface $form)
    {

    }
}