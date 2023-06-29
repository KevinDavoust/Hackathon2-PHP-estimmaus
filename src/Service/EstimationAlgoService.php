<?php

namespace App\Service;

use App\Repository\IndicatorRepository;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class EstimationAlgoService
{
    private IndicatorRepository $indicatorRepository;
    private SessionInterface $session;

    public function __construct(
        IndicatorRepository $indicatorRepository,
        RequestStack $requestStack
    ) {
        $this->indicatorRepository = $indicatorRepository;
        $this->session = $requestStack->getCurrentRequest()->getSession();
    }

    public function getEstimation(): float
    {
        $model = $this->session->get('modelEstimate');
        $memory = $this->session->get('memoryEstimate');
        $storage = $this->session->get('storageEstimate');
        $state = $this->session->get('stateEstimate');


        $modelIndicators = $this->indicatorRepository->findBy(["characteristic" => "model"]);
        $memoryIndicators = $this->indicatorRepository->findBy(["characteristic" => "memory"]);
        $storageIndicators = $this->indicatorRepository->findBy(["characteristic" => "storage"]);
        $stateIndicators = $this->indicatorRepository->findBy(["characteristic" => "state"]);

        $totalPoints = 0;

        $modelYear = $model->getYear();
        match (true) {
            $modelYear >= 2017 || $modelYear < 2019 => $totalPoints += 1,
            $modelYear < 2021 => $totalPoints += 2,
            $modelYear <= 2023 => $totalPoints += 2
        };

        foreach ($modelIndicators as $modelIndicator) {
            if ($model->getIndicator() == $modelIndicator->getClassification()) {
                $totalPoints += $modelIndicator->getValue();
            }
        }

        foreach ($memoryIndicators as $memoryIndicator) {
            if ($memory->getSize() == $memoryIndicator->getClassification()) {
                $totalPoints += $memoryIndicator->getValue();
            }
        }

        foreach ($storageIndicators as $storageIndicator) {
            if ($storage->getSize() == $storageIndicator->getClassification()) {
                $totalPoints += $storageIndicator->getValue();
            }
        }

        foreach ($stateIndicators as $stateIndicator) {
            if (strtolower($state->getType()) == $stateIndicator->getClassification()) {
                $totalPoints += $stateIndicator->getValue();
            }
        }

        return $totalPoints * 6.25;
    }
}
