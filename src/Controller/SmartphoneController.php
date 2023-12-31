<?php

namespace App\Controller;

use App\Entity\Brand;
use App\Entity\Smartphone;
use App\Form\BrandPictureType;
use App\Form\BrandType;
use App\Form\CityEstimateType;
use App\Form\ModelEstimateType;
use App\Form\SmartphoneType;
use App\Form\StateEstimateType;
use App\Repository\SmartphoneRepository;
use App\Service\BrandService;
use App\Service\CityService;
use App\Service\ModelService;
use App\Service\SessionEstimateService;
use App\Service\StateService;
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

        $sessionEstimate = $request->getSession();
        $ram = $sessionEstimate->get('memoryEstimate');
        $storage = $sessionEstimate->get('storageEstimate');

        return $this->render('smartphone/brand.html.twig', [
            'formBrandEstimate' => $formBrandEstimate->createView(),
            'brands' => $brands,
            'RAM' => $ram,
            'storage' => $storage,
        ]);
    }

    #[Route('/model', name: 'app_smartphone_model', methods: ['GET', 'POST'])]
    public function modelEstimate(SessionEstimateService $sessionEstimateService, Request $request, ModelService $modelService): Response
    {
        $models = $modelService->getModelsByBrandId($request);
        $formModelEstimate = $this->createForm(ModelEstimateType::class, null, [
            'choices' => $models,
        ]);
        $formModelEstimate->handleRequest($request);

        if ($formModelEstimate->isSubmitted() && $formModelEstimate->isValid()) {
            $modelName = $formModelEstimate->getData()->getName();

            $sessionEstimateService->addToEstimateSession('modelEstimate', 'model', 'name', $modelName, $request);
            return $this->redirectToRoute(
                'app_smartphone_state',
                [],
                Response::HTTP_SEE_OTHER
            );
        }

        $sessionEstimate = $request->getSession();
        $ram = $sessionEstimate->get('memoryEstimate');
        $storage = $sessionEstimate->get('storageEstimate');
        $brand = $sessionEstimate->get('brandEstimate');

        return $this->render('smartphone/model.html.twig', [
            'formModelEstimate' => $formModelEstimate->createView(),
            'RAM' => $ram,
            'storage' => $storage,
            'brand' => $brand,
        ]);
    }

    #[Route('/city', name: 'app_smartphone_city', methods: ['GET', 'POST'])]
    public function cityEstimate(SessionEstimateService $sessionEstimateService, Request $request, CityService $cityService): Response
    {
        $cities = $cityService->getCities();
        $formCityEstimate = $this->createForm(CityEstimateType::class);
        $formCityEstimate->handleRequest($request);

        if ($formCityEstimate->isSubmitted() && $formCityEstimate->isValid()) {
            $cityName = $formCityEstimate->getData()->getName();

            $sessionEstimateService->addToEstimateSession('cityEstimate', 'city', 'name', $cityName, $request);

            return $this->redirectToRoute('app_smartphone_brand', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('smartphone/city.html.twig', [
            'form' => $formCityEstimate->createView(),
        ]);
    }

    // #[Route('/memory', name: 'app_smartphone_memory', methods: ['GET', 'POST'])]
    // public function memoryEstimate(SessionEstimateService $sessionEstimateService, Request $request): Response
    // {
    //     $formMemoryEstimate = $this->createForm(MemoryEstimateType::class);
    //     $formMemoryEstimate->handleRequest($request);

    //     if ($formMemoryEstimate->isSubmitted() && $formMemoryEstimate->isValid()) {
    //         $memorySize = $formMemoryEstimate->getData()->getSize();

    //         $sessionEstimateService->addToEstimateSession("memoryEstimate", "memory", "size", $memorySize, $request);

    //         return $this->redirectToRoute(
    //             'app_smartphone_storage',
    //             [],
    //             Response::HTTP_SEE_OTHER
    //         );
    //     }

    //     return $this->render('smartphone/memory.html.twig', [
    //         "formMemoryEstimate" => $formMemoryEstimate
    //     ]);
    // }

    // #[Route('/storage', name: 'app_smartphone_storage', methods: ['GET', 'POST'])]
    // public function storageEstimate(SessionEstimateService $sessionEstimateService, Request $request): Response
    // {
    //     $formStorageEstimate = $this->createForm(StorageEstimateType::class);
    //     $formStorageEstimate->handleRequest($request);

    //     if ($formStorageEstimate->isSubmitted() && $formStorageEstimate->isValid()) {
    //         $storageSize = $formStorageEstimate->getData()->getSize();

    //         $sessionEstimateService->addToEstimateSession("storageEstimate", "memory", "size", $storageSize, $request);

    //         return $this->redirectToRoute(
    //             'app_smartphone_state',
    //             [],
    //             Response::HTTP_SEE_OTHER
    //         );
    //     }

    //     return $this->render('smartphone/storage.html.twig', [
    //         "formStorageEstimate" => $formStorageEstimate
    //     ]);
    // }


    #[Route('/state', name: 'app_smartphone_state', methods: ['GET', 'POST'])]
    public function stateEstimate(SessionEstimateService $sessionEstimateService, StateService $stateService, Request $request): Response
    {
        $formStateEstimate = $this->createForm(StateEstimateType::class);
        $formStateEstimate->handleRequest($request);

        if ($formStateEstimate->isSubmitted()) {
            //dd($formStateEstimate->getData()->getType());
            //$stateType = $formStateEstimate->get('type')->getData()->getType();
            //dd($formStateEstimate->get('type')->getViewData());
            $stateType = $formStateEstimate->get('type')->getViewData();
            $sessionEstimateService->addToEstimateSession('stateEstimate', 'State', 'type', $stateType, $request);

            return $this->redirectToRoute(
                'app_estimation',
                [],
                Response::HTTP_SEE_OTHER
            );
        }

        $states = $stateService->getStates();

        $sessionEstimate = $request->getSession();
        $ram = $sessionEstimate->get('memoryEstimate');
        $storage = $sessionEstimate->get('storageEstimate');
        $brand = $sessionEstimate->get('brandEstimate');
        $model = $sessionEstimate->get('modelEstimate');

        return $this->render('smartphone/state.html.twig', [
            'formStateEstimate' => $formStateEstimate->createView(),
            'states' => $states,
            'RAM' => $ram,
            'storage' => $storage,
            'brand' => $brand,
            'model' => $model,
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

    /*    #[Route('/{id}', name: 'app_smartphone_show', methods: ['GET'])]*/
    public function show(Smartphone $smartphone): Response
    {
        return $this->render('smartphone/show.html.twig', [
            'smartphone' => $smartphone,
        ]);
    }

    /*    #[Route('/{id}/edit', name: 'app_smartphone_edit', methods: ['GET', 'POST'])]*/
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

    /*    #[Route('/{id}', name: 'app_smartphone_delete', methods: ['POST'])]*/
    public function delete(Request $request, Smartphone $smartphone, SmartphoneRepository $smartphoneRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $smartphone->getId(), $request->request->get('_token'))) {
            $smartphoneRepository->remove($smartphone, true);
        }

        return $this->redirectToRoute('app_smartphone_index', [], Response::HTTP_SEE_OTHER);
    }
}
