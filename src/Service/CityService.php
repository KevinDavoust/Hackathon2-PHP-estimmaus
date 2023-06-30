<?php

namespace App\Service;

use App\Entity\City;
use App\Repository\CityRepository;
use App\Repository\ModelRepository;
use Symfony\Component\HttpFoundation\Request;

class CityService
{
    private SessionEstimateService $sessionEstimateService;
    private CityRepository $cityRepository;

    public function __construct(SessionEstimateService $sessionEstimateService, CityRepository $cityRepository)
    {
        $this->sessionEstimateService = $sessionEstimateService;
        $this->cityRepository = $cityRepository;
    }

    public function getCities(): array
    {
        return $this->cityRepository->findAll();
    }
}