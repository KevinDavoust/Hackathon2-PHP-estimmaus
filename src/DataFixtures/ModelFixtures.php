<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use App\Entity\Model;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ModelFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $smartphoneModels = [
            ["model" => "iPhone 13 Pro", "brand" => "Apple", "year" => 2021],
            ["model" => "Samsung Galaxy S21 Ultra", "brand" => "Samsung", "year" => 2021],
            ["model" => "Huawei P40 Pro", "brand" => "Huawei", "year" => 2020],
            ["model" => "Xiaomi Mi 11", "brand" => "Xiaomi", "year" => 2020],
            ["model" => "Oppo Find X3 Pro", "brand" => "Oppo", "year" => 2021],
            ["model" => "Vivo X60 Pro+", "brand" => "Vivo", "year" => 2021],
            ["model" => "OnePlus 9 Pro", "brand" => "OnePlus", "year" => 2021],
            ["model" => "Google Pixel 6 Pro", "brand" => "Google", "year" => 2021],
            ["model" => "Motorola Edge Plus", "brand" => "Motorola", "year" => 2020],
            ["model" => "LG Velvet", "brand" => "LG", "year" => 2020],
            ["model" => "Sony Xperia 1 III", "brand" => "Sony", "year" => 2021],
            ["model" => "Nokia 8.3 5G", "brand" => "Nokia", "year" => 2020],
            ["model" => "Realme GT", "brand" => "Realme", "year" => 2021],
            ["model" => "Lenovo Legion Phone Duel 2", "brand" => "Lenovo", "year" => 2021],
            ["model" => "HTC U12+", "brand" => "HTC", "year" => 2018],
            ["model" => "Asus ROG Phone 5", "brand" => "Asus", "year" => 2021],
            ["model" => "BlackBerry KEY2", "brand" => "BlackBerry", "year" => 2018],
            ["model" => "ZTE Axon 30 Ultra", "brand" => "ZTE", "year" => 2021],
            ["model" => "Meizu 18 Pro", "brand" => "Meizu", "year" => 2021],
            ["model" => "Honor 50 Pro", "brand" => "Honor", "year" => 2021]
        ];


        foreach ($smartphoneModels as $smartphoneModel) {
            $model = new Model();

            $model->setName($smartphoneModel["model"]);
            $model->setBrand($this->getReference("brand_" . $smartphoneModel["brand"]));
            $model->setYear($smartphoneModel["year"]);
            $model->setPicturePath("test.png");

            $manager->persist($model);
            $this->setReference("model_" . str_replace(" ", "_", $model->getName()), $model);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [BrandFixtures::class];
    }
}
