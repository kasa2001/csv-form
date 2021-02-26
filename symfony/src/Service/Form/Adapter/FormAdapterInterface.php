<?php


namespace App\Service\Form\Adapter;


use App\Service\Parser\ParserServiceInterface;
use Symfony\Component\Form\FormInterface;

interface FormAdapterInterface
{

    function __construct(ParserServiceInterface $parserService);

    function doAdapter(FormInterface $form);
}