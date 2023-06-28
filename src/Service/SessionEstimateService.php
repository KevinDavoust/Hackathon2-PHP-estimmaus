<?php

namespace App\Service;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\HttpFoundation\Request;

class SessionEstimateService
{
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function addToEstimateSession(string $key, string $entityName, string $columnName, string $value, Request $request): void
    {

        $estimateSession = $request->getSession();

        $entity = $this->entityManager->getRepository($entityName)->findOneBy([$columnName => $value]);

        $estimateSession->set($key, $entity);
    }
}