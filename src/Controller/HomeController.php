<?php

namespace App\Controller;

use App\Form\PreselectionType;
use App\Form\RamAndStorageType;
use App\Repository\SmartphoneRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /*#[Route('/home', name: 'app_home')]*/
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }

    #[Route('/faq', name: 'app_faq')]
    public function faq(): Response
    {
        return $this->render('home/faq.html.twig');
    }

    #[Route('/preselection', name: 'app_preselection_1', methods: ['POST', 'GET'])]
    public function preselection(Request $request): Response
    {
        $form = $this->createForm(PreselectionType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
                return $this->redirectToRoute('app_preselection_2', [], Response::HTTP_SEE_OTHER);
            }

        return $this->renderForm('preselection/index.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/preselection/etape2', name: 'app_preselection_2', methods: ['POST', 'GET'])]
    public function preselectionSuite(Request $request): Response
    {
        $form = $this->createForm(RamAndStorageType::class);
        $form->handleRequest($request);
        $errorRam = $errorStorage = "";

        if ($form->isSubmitted() && $form->isValid()) {
            $ram = $form->get('RAM')->getData();
            $storage = $form->get('storage')->getData();
            if ( $ram >= 2 && $storage >= 16) {
                $sessionEstimate = $request->getSession();
                $sessionEstimate->set('ramEstimate', $ram);
                $sessionEstimate->set('storageEstimate', $storage);
                return $this->redirectToRoute('app_smartphone_brand', [], Response::HTTP_SEE_OTHER);
            } else {
                if ($ram < 2) {
                    $errorRam = 'RAM insuffisante';
                }
                if ($storage < 16) {
                    $errorStorage = 'Mémoire insuffisante';
                }
            }
        }

        return $this->renderForm('preselection/index.html.twig', [
            'form' => $form,
            'errorRam' => $errorRam,
            'errorStorage' => $errorStorage,
        ]);
    }

    #[Route('/accueil', name: 'app_accueil')]
    public function accueil(): Response
    {
        return $this->render('home/accueil.html.twig');
    }
}
