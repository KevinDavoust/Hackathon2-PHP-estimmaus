<?php

namespace App\Controller;

use App\Entity\Indicator;
use App\Entity\Smartphone;
use App\Repository\CityRepository;
use App\Repository\IndicatorRepository;
use App\Repository\SmartphoneRepository;
use App\Service\SessionEstimateService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\EstimationAlgoService;

class EstimationController extends AbstractController
{
    #[Route('/estimation', name: 'app_estimation')]
    public function results(
        EstimationAlgoService $estimationAlgoService,
        CityRepository $cityRepository,
        Request $request
    ): Response {
        $cities = $cityRepository->findAll();
        $estimation = $estimationAlgoService->getEstimation();
        return $this->render('estimation/result.html.twig', [
            "estimation" => $estimation,
            "cities" => $cities
        ]);
    }

    #[Route("/saveSmartphone", name: "app_saveSmartphone")]
    public function save(
        Request $request,
        SmartphoneRepository $smartphoneRepository
    ): Response {
        $session = $request->getSession();
        $smartphone = new Smartphone();

        $smartphone->setModel($session->get("modelEstimate"));
        $smartphone->setMemory($session->get("memoryEstimate"));
        $smartphone->setStorage($session->get("storageEstimate"));
        $smartphone->setState($session->get("stateEstimate"));
        $smartphone->setCity($session->get("cityEstimate"));

        // dd($smartphone);

        $smartphoneRepository->save($smartphone);

        $this->addFlash("success", "Sauvegardé!");
        return $this->redirectToRoute("app_accueil");
    }
}
