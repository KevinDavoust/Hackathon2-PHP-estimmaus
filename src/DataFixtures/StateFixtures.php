<?php

namespace App\DataFixtures;

use App\Entity\State;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StateFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $stateTypes = [
            "DEEE",
            "REPARABLE",
            "RECONDITIONNABLE",
            "RECONDITIONNÉ"
        ];

        foreach ($stateTypes as $key => $stateType) {
            $state = new State();
            $state->setType($stateType);
            $state->setPercentage(($key + 1) * 10);

            $manager->persist($state);
            $this->addReference("state_" . $state->getType(), $state);
        }

        $manager->flush();
    }
}
