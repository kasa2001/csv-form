<?php


namespace App\Service\Form;


use App\Exception\AbstractFileException;
use App\Service\Form\Adapter\FormAdapterInterface;
use Symfony\Component\Form\FormError;
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

    /**
     * @param FormInterface $form
     * @param Request $request
     * @return mixed
     */
    function processForm(FormInterface $form, Request $request)
    {
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                return $this->formAdapter->doAdapter($form);
            } catch (AbstractFileException $e) {
                $form->addError(
                    new FormError(
                        $e->getMessage()
                    )
                );
                return false;
            }
        }

        return false;
    }

    function renderForm(FormInterface $form): FormView
    {
        return $form->createView();
    }


}