<?php


namespace App\Controller;



use App\Form\CsvFileUpload;
use App\Service\Form\FormServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CsvController extends AbstractController
{
    /**
     * @Route("/csv-form", name="csv-form", methods={"GET"})
     * @param FormServiceInterface $formService
     * @return Response
     */
    public function form(FormServiceInterface $formService): Response
    {
        return $this->render(
            'form/form.html.twig',
            [
                'form' => $formService->renderForm(
                    $this->createForm(
                        CsvFileUpload::class
                    )
                )
            ]
        );
    }

    /**
     * @Route("/csv-form", name="csv-form-post", methods={"POST"})
     * @param FormServiceInterface $formService
     * @param Request $request
     * @return Response
     */
    public function formAction(FormServiceInterface $formService,Request $request): Response
    {
        $form = $this->createForm(CsvFileUpload::class);

        if (($result = $formService->processForm($form, $request))) {
            return $this->render(
                'form/result.html.twig',
                [
                    'result' => $result
                ]
            );
        }

        return $this->render(
            'form/form.html.twig',
            [
                'form' => $formService->renderForm(
                    $form
                )
            ]
        );
    }
}