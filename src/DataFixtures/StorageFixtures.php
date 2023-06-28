<?php

namespace App\DataFixtures;

use App\Entity\Storage;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StorageFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $sizes = [2, 4, 8, 16, 32, 64, 128, 256, 512, 1000];

        foreach ($sizes as $key => $size) {
            $storage = new Storage();
            $storage->setSize($size);
            $storage->setIndice($key + 1);

            $manager->persist($storage);
            $this->addReference("storage_" . $storage->getSize(), $storage);
        }

        $manager->flush();
    }
}
