<?php

namespace App\Service;

use App\Repository\ModelRepository;
use Symfony\Component\HttpFoundation\Request;

class ModelService
{
    private SessionEstimateService $sessionEstimateService;
    private ModelRepository $modelRepository;

    public function __construct(SessionEstimateService $sessionEstimateService, ModelRepository $modelRepository)
    {
        $this->sessionEstimateService = $sessionEstimateService;
        $this->modelRepository = $modelRepository;
    }

    public function getModels(): array
    {
        return $this->modelRepository->findAll();
    }

    public function getModelsByBrandId(Request $request): array
    {
        $brand = $this->sessionEstimateService->getFromEstimateSession('brandEstimate', $request);
        $brandId = $brand->getId();
        return $this->modelRepository->findBy(['brand' => $brandId]);
    }
}