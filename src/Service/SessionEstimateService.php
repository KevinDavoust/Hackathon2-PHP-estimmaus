<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class SessionEstimateService
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function addToEstimateSession(string $key, string $entityName, string $columnName, string $value, Request $request): void
    {
        $estimateSession = $request->getSession();

        $entityName = $this->stringToEntityName($entityName);

        $entity = $this->entityManager->getRepository($entityName)->findOneBy([$columnName => $value]);

        $estimateSession->set($key, $entity);
    }

    public function getFromEstimateSession(string $key, Request $request) // TODO : find the right type
    {
        $estimateSession = $request->getSession();

        return $estimateSession->get($key);
    }

    public function stringToEntityName(string $string): string
    {
        $string = ucfirst($string);

        return "App\Entity\\$string";
    }
}
