<?php


namespace App\Service\Form;


use App\Service\Form\Adapter\FormAdapterInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

interface FormServiceInterface
{
    function __construct(FormAdapterInterface $formAdapter);

    function processForm(FormInterface $form, Request $request);

    function renderForm(FormInterface $form);
}