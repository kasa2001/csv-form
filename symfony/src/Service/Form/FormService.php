<?php


namespace App\Service\Form;


use App\Service\Form\Adapter\FormAdapterInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\Request;

class FormService implements FormServiceInterface
{
    /**
     * @var FormAdapterInterface
     */
    private $formAdapter;

    public function __construct(FormAdapterInterface $formAdapter)
    {
        $this->formAdapter = $formAdapter;
    }

    function processForm(FormInterface $form, Request $request)
    {

    }

    function renderForm(FormInterface $form): FormView
    {
        return $form->createView();
    }


}