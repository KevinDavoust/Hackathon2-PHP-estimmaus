<?php

namespace App\Controller;

use App\Entity\Smartphone;
use App\Form\BrandType;
use App\Form\ModelEstimateType;
use App\Form\SmartphoneType;
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
        if ($this->isCsrfTokenValid('delete'.$smartphone->getId(), $request->request->get('_token'))) {
            $smartphoneRepository->remove($smartphone, true);
        }

        return $this->redirectToRoute('app_smartphone_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/brand', name: 'app_smartphone_brand', methods: ['GET, POST'])]
    public function brandEstimate(SessionEstimateService $sessionEstimateService, BrandService $brandService, Request $request): Response
    {
        $formBrandEstimate = $this->createForm(BrandType::class);

        if ($formBrandEstimate->isSubmitted() && $formBrandEstimate->isValid()) {
            $brandName = $request->request->get('brand');

            $sessionEstimateService->addToEstimateSession('brandEstimate', 'Brand', 'name', $brandName, $request);

            return $this->redirectToRoute(
                'app_smartphone_model',
                [],
                Response::HTTP_SEE_OTHER);
        }

        $brands = $brandService->getBrands();

        return $this->render('smartphone/brand.html.twig', [
            'formBrandEstimate' => $formBrandEstimate->createView(),
            'brands' => $brands,
        ]);

    }

    #[Route('/model', name: 'app_smartphone_model', methods: ['GET, POST'])]
    public function modelEstimate(SessionEstimateService $sessionEstimateService, Request $request): Response
    {
        $formModelEstimate = $this->createForm(ModelEstimateType::class);

        if ($formModelEstimate->isSubmitted() && $formModelEstimate->isValid()) {
            $modelName = $request->request->get('model');

            $sessionEstimateService->addToEstimateSession('modelEstimate', 'Model', 'name', $modelName, $request);

            return $this->redirectToRoute(
                'app_smartphone_state',
                [],
                Response::HTTP_SEE_OTHER);
        }

        return $this->render('smartphone/brand.html.twig', [
            'formModelEstimate' => $formModelEstimate->createView(),
        ]);

    }



}
