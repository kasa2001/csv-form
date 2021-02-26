<?php


namespace App\Controller;



use App\Service\Form\FormServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
     */
    public function form()
    {

    }

    /**
     * @Route("/csv-form", name="csv-form-post", methods={"POST"})
     * @param Request $request
     */
    public function formAction(Request $request)
    {

    }
}