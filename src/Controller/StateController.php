<?php

namespace App\Controller;

use App\Entity\State;
use App\Form\StateType;
use App\Repository\StateRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/state')]
class StateController extends AbstractController
{
    #[Route('/', name: 'app_state_index', methods: ['GET'])]
    public function index(StateRepository $stateRepository): Response
    {
        return $this->render('state/index.html.twig', [
            'states' => $stateRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_state_new', methods: ['GET', 'POST'])]
    public function new(Request $request, StateRepository $stateRepository): Response
    {
        $state = new State();
        $form = $this->createForm(StateType::class, $state);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $stateRepository->save($state, true);

            return $this->redirectToRoute('app_state_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('state/new.html.twig', [
            'state' => $state,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_state_show', methods: ['GET'])]
    public function show(State $state): Response
    {
        return $this->render('state/show.html.twig', [
            'state' => $state,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_state_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, State $state, StateRepository $stateRepository): Response
    {
        $form = $this->createForm(StateType::class, $state);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $stateRepository->save($state, true);

            return $this->redirectToRoute('app_state_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('state/edit.html.twig', [
            'state' => $state,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_state_delete', methods: ['POST'])]
    public function delete(Request $request, State $state, StateRepository $stateRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$state->getId(), $request->request->get('_token'))) {
            $stateRepository->remove($state, true);
        }

        return $this->redirectToRoute('app_state_index', [], Response::HTTP_SEE_OTHER);
    }
}
