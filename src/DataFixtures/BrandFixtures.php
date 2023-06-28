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
                "Oppo",
                "Vivo",
                "OnePlus",
                "Google",
                "Motorola",
                "LG",
                "Sony",
                "Nokia",
                "Realme",
                "Lenovo",
                "HTC",
                "Asus",
                "BlackBerry",
                "ZTE",
                "Meizu",
                "Honor",
                "Autres"
            ];

        foreach ($brandNames as $key => $brandName) {
            $brand = new Brand();
            $brand->setName($brandName);
            $brand->setPicturePath("test.png");

            $manager->persist($brand);
            $this->addReference("brand_" . $brand->getName(), $brand);
        }

        $manager->flush();
    }
}
