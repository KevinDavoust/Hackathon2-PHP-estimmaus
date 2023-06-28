<?php

namespace App\DataFixtures;

use App\Entity\Memory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MemoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $sizes = [2, 4, 8, 12, 16, 32];

        foreach ($sizes as $key => $size) {
            $memory = new Memory;
            $memory->setSize($size);
            $memory->setIndice($key + 1);

            $manager->persist($memory);
            $this->addReference("memory_" . $memory->getSize(), $memory);
        }

        $manager->flush();
    }
}
