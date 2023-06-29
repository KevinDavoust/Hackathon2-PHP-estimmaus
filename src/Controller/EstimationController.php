<?php

namespace App\Controller;

use App\Entity\Indicator;
use App\Repository\IndicatorRepository;
use App\Service\SessionEstimateService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\EstimationAlgoService;

class EstimationController extends AbstractController
{
    #[Route('/estimation', name: 'app_estimation')]
    public function results(EstimationAlgoService $estimationAlgoService, Request $request, IndicatorRepository $indicatorRepository): Response
    {
        $estimation = $estimationAlgoService->getEstimation();
        return $this->render('estimation/result.html.twig', [
            "estimation" => $estimation
        ]);
    }
}
