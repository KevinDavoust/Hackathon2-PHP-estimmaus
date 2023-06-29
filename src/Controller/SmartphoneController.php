<?php

namespace App\Controller;

use App\Entity\Brand;
use App\Entity\Smartphone;
use App\Form\BrandType;
use App\Form\ModelEstimateType;
use App\Form\MemoryEstimateType;
use App\Form\SmartphoneType;
use App\Form\StateEstimateType;
use App\Repository\SmartphoneRepository;
use App\Service\BrandService;
use App\Service\SessionEstimateService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/smartphone')]
class SmartphoneController extends AbstractController
{
    #[Route('/', name: 'app_smartphone_index', methods: ['GET'])]
    public function index(SmartphoneRepository $smartphoneRepository): Response
    {
        return $this->render('smartphone/index.html.twig', [
            'smartphones' => $smartphoneRepository->findAll(),
        ]);
    }

    #[Route('/brand', name: 'app_smartphone_brand', methods: ['GET', 'POST'])]
    public function brandEstimate(Request $request, SessionEstimateService $sessionEstimateService, BrandService $brandService): Response
    {
        $formBrandEstimate = $this->createForm(BrandType::class);
        $formBrandEstimate->handleRequest($request);

        if ($formBrandEstimate->isSubmitted() && $formBrandEstimate->isValid()) {
            $brandName = $formBrandEstimate->getData()->getName();

            $sessionEstimateService->addToEstimateSession('brandEstimate', 'brand', 'name', $brandName, $request);

            return $this->redirectToRoute(
                'app_smartphone_model',
                [],
                Response::HTTP_SEE_OTHER
            );
        }

        $brands = $brandService->getBrands();

        return $this->render('smartphone/brand.html.twig', [
            'formBrandEstimate' => $formBrandEstimate->createView(),
            'brands' => $brands,
        ]);
    }

    #[Route('/model', name: 'app_smartphone_model', methods: ['GET', 'POST'])]
    public function modelEstimate(SessionEstimateService $sessionEstimateService, Request $request): Response
    {
        $session = $request->getSession()->get('brandEstimate');
        var_dump($session);
        $formModelEstimate = $this->createForm(ModelEstimateType::class);
        $formModelEstimate->handleRequest($request);

        if ($formModelEstimate->isSubmitted() && $formModelEstimate->isValid()) {
            $modelName = $formModelEstimate->getData()->getName();

            $sessionEstimateService->addToEstimateSession('modelEstimate', 'model', 'name', $modelName, $request);

            return $this->redirectToRoute(
                'app_smartphone_memory',
                [],
                Response::HTTP_SEE_OTHER
            );
        }

        return $this->render('smartphone/model.html.twig', [
            'formModelEstimate' => $formModelEstimate->createView(),
        ]);
    }

    #[Route('/memory', name: 'app_smartphone_memory', methods: ['GET', 'POST'])]
    public function memoryEstimate(SessionEstimateService $sessionEstimateService, Request $request): Response
    {
        $session = $request->getSession()->get('brandEstimate');
        var_dump($session);
        $formMemoryEstimate = $this->createForm(MemoryEstimateType::class);
        $formMemoryEstimate->handleRequest($request);

        if ($formMemoryEstimate->isSubmitted() && $formMemoryEstimate->isValid()) {
            $memorySize = $formMemoryEstimate->getData()->getSize();

            $sessionEstimateService->addToEstimateSession("memoryEstimate", "memory", "size", $memorySize, $request);

            return $this->redirectToRoute(
                'app_smartphone_storage',
                [],
                Response::HTTP_SEE_OTHER
            );
        }

        return $this->render('smartphone/memory.html.twig', [
            "formMemoryEstimate" => $formMemoryEstimate
        ]);
    }

    #[Route('/storage', name: 'app_smartphone_storage', methods: ['GET', 'POST'])]
    public function storageEstimate(SessionEstimateService $sessionEstimateService, Request $request): Response
    {
        $session = $request->getSession()->get('memoryEstimate');
        var_dump($session);
        $formStorageEstimate = $this->createForm(StorageEstimateType::class);
        $formStorageEstimate->handleRequest($request);

        if ($formStorageEstimate->isSubmitted() && $formStorageEstimate->isValid()) {
            $storageSize = $formStorageEstimate->getData()->getSize();

            $sessionEstimateService->addToEstimateSession("memoryEstimate", "memory", "size", $storageSize, $request);

            return $this->redirectToRoute(
                'app_smartphone_state',
                [],
                Response::HTTP_SEE_OTHER
            );
        }

        return $this->render('smartphone/memory.html.twig', [
            "formMemoryEstimate" => $formStorageEstimate
        ]);
    }


    #[Route('/state', name: 'app_smartphone_state', methods: ['GET', 'POST'])]
    public function stateEstimate(SessionEstimateService $sessionEstimateService, Request $request): Response
    {
        $session = $request->getSession()->get('memoryEstimate');
        var_dump($session);
        $formStateEstimate = $this->createForm(StateEstimateType::class);
        $formStateEstimate->handleRequest($request);

        if ($formStateEstimate->isSubmitted() && $formStateEstimate->isValid()) {
            $stateType = $formStateEstimate->getData()->getType();

            $sessionEstimateService->addToEstimateSession('stateEstimate', 'State', 'type', $stateType, $request);

            return $this->redirectToRoute(
                'app_smartphone_result',
                [],
                Response::HTTP_SEE_OTHER
            );
        }

        return $this->render('smartphone/state.html.twig', [
            'formStateEstimate' => $formStateEstimate->createView(),
        ]);
    }

    #[Route('/result', name: 'app_smartphone_result', methods: ['GET', 'POST'])]
    public function resultEstimate(SessionEstimateService $sessionEstimateService, Request $request): Response
    {
        $session = $request->getSession()->get('stateEstimate');
        var_dump($session);
        $brand = $sessionEstimateService->getFromEstimateSession('brandEstimate', $request);
        $model = $sessionEstimateService->getFromEstimateSession('modelEstimate', $request);
        $state = $sessionEstimateService->getFromEstimateSession('stateEstimate', $request);

        return $this->render('smartphone/result.html.twig', [
            'brand' => $brand,
            'model' => $model,
            'state' => $state,
        ]);
    }

    #[Route('/new', name: 'app_smartphone_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SmartphoneRepository $smartphoneRepository): Response
    {
        $smartphone = new Smartphone();
        $form = $this->createForm(SmartphoneType::class, $smartphone);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $smartphoneRepository->save($smartphone, true);

            return $this->redirectToRoute('app_smartphone_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('smartphone/new.html.twig', [
            'smartphone' => $smartphone,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_smartphone_show', methods: ['GET'])]
    public function show(Smartphone $smartphone): Response
    {
        return $this->render('smartphone/show.html.twig', [
            'smartphone' => $smartphone,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_smartphone_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Smartphone $smartphone, SmartphoneRepository $smartphoneRepository): Response
    {
        $form = $this->createForm(SmartphoneType::class, $smartphone);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $smartphoneRepository->save($smartphone, true);

            return $this->redirectToRoute('app_smartphone_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('smartphone/edit.html.twig', [
            'smartphone' => $smartphone,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_smartphone_delete', methods: ['POST'])]
    public function delete(Request $request, Smartphone $smartphone, SmartphoneRepository $smartphoneRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $smartphone->getId(), $request->request->get('_token'))) {
            $smartphoneRepository->remove($smartphone, true);
        }

        return $this->redirectToRoute('app_smartphone_index', [], Response::HTTP_SEE_OTHER);
    }
}
