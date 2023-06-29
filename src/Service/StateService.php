<?php

namespace App\Service;

use App\Repository\StateRepository;

class StateService
{
    private StateRepository $stateRepository;

    public function __construct(StateRepository $stateRepository)
    {
        $this->stateRepository = $stateRepository;
    }

    public function getStates(): array
    {
        return $this->stateRepository->findAll();
    }
}