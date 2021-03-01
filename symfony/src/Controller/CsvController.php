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

    private $formService;

    public function CsvController(FormServiceInterface $formService)
    {
        $this->formService = $formService;
    }

    /**
     * @Route("/csv-form", name="csv-form", methods={"GET"})
     * @return Response
     */
    public function form(): Response
    {
        return $this->render(
            'form/form.html.twig',
            [
                'form' => $this->formService->renderForm(
                    $this->createForm(
                        CsvFileUpload::class
                    )
                )
            ]
        );
    }

    /**
     * @Route("/csv-form", name="csv-form-post", methods={"POST"})
     * @param Request $request
     * @return Response
     */
    public function formAction(Request $request): Response
    {

    }
}