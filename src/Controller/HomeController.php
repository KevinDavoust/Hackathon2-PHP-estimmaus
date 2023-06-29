<?php

namespace App\Controller;

use App\Form\PreselectionType;
use App\Repository\SmartphoneRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/faq', name: 'app_faq')]
    public function faq(): Response
    {
        return $this->render('home/faq.html.twig');
    }

    #[Route('/preselection', name: 'app_preselection', methods: ['POST', 'GET'])]
    public function preselection(Request $request, SmartphoneRepository $smartphoneRepository): Response
    {
        $form = $this->createForm(PreselectionType::class);
        $form->handleRequest($request);
        $error = "";

        if ($form->isSubmitted() && $form->isValid()) {
            $ram = $form->get('RAM')->getData();
            $storage = $form->get('storage')->getData();
            if ( $ram >= 2 && $storage >= 16) {
                $sessionEstimate = $request->getSession();
                $sessionEstimate->set('ramEstimate', $ram);
                $sessionEstimate->set('storageEstimate', $storage);
            } else {
                if ($ram < 2) {
                    $error = 'RAM insuffisante';
                }
                if ($storage < 16) {
                    $error = 'Mémoire insuffisante';
                }
            }
        }

        return $this->renderForm('preselection/index.html.twig', [
            'form' => $form,
            'error' => $error,
        ]);
    }
}
