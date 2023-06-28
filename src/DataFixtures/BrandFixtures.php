<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BrandFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $brandNames =
            [
                "Apple",
                "Samsung",
                "Huawei",
                "Xiaomi",
                "OnePlus",
                "Google",
                "Oppo",
                "Vivo",
                "LG",
                "Motorola"
            ];

        foreach ($brandNames as $key => $brandName) {
            $brand = new Brand();
            $brand->setName($brandName);

            $manager->persist($brand);
            $this->addReference("brand_" . $brand->getName(), $brand);
        }

        $manager->flush();
    }
}
