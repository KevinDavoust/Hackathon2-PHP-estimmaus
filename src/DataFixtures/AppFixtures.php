<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use App\Entity\Category;
use App\Entity\City;
use App\Entity\Indicator;
use App\Entity\Memory;
use App\Entity\Model;
use App\Entity\Smartphone;
use App\Entity\State;
use App\Entity\Storage;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $indicatorsData = [
            "model" => [
                "budget" => 1,
                "flagship" => 2,
                "premium" => 3,
                "professionnal" => 4
            ],
            "year" => [
                2017 => 1,
                2019 => 2,
                2021 => 3,
                2023 => 4,
            ],
            "memory" => [
                2 => 1,
                8 => 2,
                12 => 3,
                16 => 4
            ],
            "storage" => [
                16 => 1,
                32 => 2,
                64 => 3,
                128 => 4
            ],
            "state" => [
                "reparable" => 1,
                "reconditionable" => 2,
                "reconditionné" => 3,
                "neuf" => 4
            ]
        ];

        $indicators = [];
        foreach ($indicatorsData as $characteristic => $details) {
            foreach ($details as $classification => $value) {
                $indicator = new Indicator();

                $indicator->setCharacteristic($characteristic);
                $indicator->setClassification($classification);
                $indicator->setValue($value);

                $manager->persist($indicator);
                $indicators[] = $indicator;
            }
        }

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

        $brands = [];
        foreach ($brandNames as $key => $brandName) {
            $brand = new Brand();
            $brand->setName($brandName);

            $manager->persist($brand);
            $brands[] = $brand;
        }

        $smartphoneModels = [
            ["model" => "iPhone 13 Pro", "brand" => "Apple", "year" => 2021,],
            ["model" => "Samsung Galaxy S21 Ultra", "brand" => "Samsung", "year" => 2021,],
            ["model" => "Huawei P40 Pro", "brand" => "Huawei", "year" => 2020,],
            ["model" => "Xiaomi Mi 11", "brand" => "Xiaomi", "year" => 2020,],
            ["model" => "Oppo Find X3 Pro", "brand" => "Oppo", "year" => 2021,],
            ["model" => "Vivo X60 Pro+", "brand" => "Vivo", "year" => 2021,],
            ["model" => "OnePlus 9 Pro", "brand" => "OnePlus", "year" => 2021,],
            ["model" => "Google Pixel 6 Pro", "brand" => "Google", "year" => 2021,],
            ["model" => "Motorola Edge Plus", "brand" => "Motorola", "year" => 2020,],
            ["model" => "LG Velvet", "brand" => "LG", "year" => 2020,],
            ["model" => "Sony Xperia 1 III", "brand" => "Sony", "year" => 2021,],
            ["model" => "Nokia 8.3 5G", "brand" => "Nokia", "year" => 2020,],
            ["model" => "Realme GT", "brand" => "Realme", "year" => 2021,],
            ["model" => "Lenovo Legion Phone Duel 2", "brand" => "Lenovo", "year" => 2021,],
            ["model" => "HTC U12+", "brand" => "HTC", "year" => 2018,],
            ["model" => "Asus ROG Phone 5", "brand" => "Asus", "year" => 2021,],
            ["model" => "BlackBerry KEY2", "brand" => "BlackBerry", "year" => 2018,],
            ["model" => "ZTE Axon 30 Ultra", "brand" => "ZTE", "year" => 2021,],
            ["model" => "Meizu 18 Pro", "brand" => "Meizu", "year" => 2021,],
            ["model" => "Honor 50 Pro", "brand" => "Honor", "year" => 2021,]
        ];

        $modelClassifications = [
            "budget",
            "flagship",
            "premium",
            "professionnal"
        ];

        $models = [];
        foreach ($smartphoneModels as $smartphoneModel) {
            $model = new Model();

            $model->setName($smartphoneModel["model"]);
            $model->setYear($smartphoneModel["year"]);
            $model->setIndicator($modelClassifications[array_rand($modelClassifications)]);
            $model->setPicturePath("test.png");

            foreach ($brands as $brand) {
                if ($brand->getName() == $smartphoneModel["brand"]) {
                    $model->setBrand($brand);
                }
            }

            $manager->persist($model);
            $this->setReference("model_" . str_replace(" ", "_", $model->getName()), $model);
            $models[] = $model;
        }

        $sizes = [2, 4, 8, 16, 32, 64, 128, 256, 512, 1000];

        $storages = [];
        foreach ($sizes as $key => $size) {
            $storage = new Storage();
            $storage->setSize($size);

            $manager->persist($storage);
            $storages[] = $storage;
            $sizes[] = $size;
        }

        $sizes = [2, 4, 8, 12, 16, 32];

        $memories = [];
        foreach ($sizes as $key => $size) {
            $memory = new Memory;
            $memory->setSize($size);

            $manager->persist($memory);
            $memories[] = $memory;
        }

        $categoryData = [
            "1 - HC" => [0, 0, 0],
            "2 - C" => [90, 165, 20],
            "3 - B" => [165, 255, 40],
            "4 - A" => [255, 375, 60],
            "5 - Premium" => [375, 1000, 80]
        ];

        $categories = [];
        foreach ($categoryData as $name => $data) {
            $category = new Category();
            $category->setName($name);
            $category->setValMin($data[0]);
            $category->setValMax($data[1]);
            $category->setPrice($data[2]);

            $manager->persist($category);
            $categories[] = $category;
        }



        $stateTypes = [
            "RÉPARABLE",
            "RECONDITIONNABLE",
            "RECONDITIONNÉ",
            "NEUF"
        ];

        $states = [];
        foreach ($stateTypes as $key => $stateType) {
            $state = new State();
            $state->setType($stateType);
            $state->setPercentage(($key + 1) * 10);

            switch ($stateType) {
                case 'REPARABLE' :
                    $state->setDescription("Un téléphone réparable s'allume mais présente des fissures majeures sur la coque et l'écran");
                    break;
                case 'RECONDITIONNABLE' :
                    $state->setDescription("Un téléphone reconditionnable s'allume mais présente des fissures mineures sur la coque et l'écran");
                    break;
                case 'RECONDITIONNÉ' :
                    $state->setDescription("Un téléphone reconditionné s'allume et présente des micro-fissures sur la coque et l'écran");
                    break;
                case 'NEUF' :
                    $state->setDescription("Un téléphone neuf s'allume et ne présente aucune fissure sur la coque et l'écran");
                    break;
            }

            $manager->persist($state);
            $states[] = $state;
        }
        $cities = array(
            array('Ville' => 'Paris', 'zipCode' => '75000'),
            array('Ville' => 'Marseille', 'zipCode' => '13000'),
            array('Ville' => 'Lyon', 'zipCode' => '69000'),
            array('Ville' => 'Toulouse', 'zipCode' => '31000'),
            array('Ville' => 'Nice', 'zipCode' => '06000'),
            array('Ville' => 'Nantes', 'zipCode' => '44000'),
            array('Ville' => 'Strasbourg', 'zipCode' => '67000'),
            array('Ville' => 'Montpellier', 'zipCode' => '34000'),
            array('Ville' => 'Bordeaux', 'zipCode' => '33000'),
            array('Ville' => 'Lille', 'zipCode' => '59000')
        );

        foreach ($cities as $key => $cityData) {
            $city = new City();
            $city->setName($cityData['Ville']);
            $city->setZipCode($cityData['zipCode']);
            $this->addReference("city_" . $key, $city);
            $manager->persist($city);
        }

        $phonesAmount = 20;

        for ($i = 0; $i < $phonesAmount; $i++) {
            $smartphone = new Smartphone();

            $smartphone->setModel($models[array_rand($models)]);
            $smartphone->setMemory($memories[array_rand($memories)]);
            $smartphone->setStorage($storages[array_rand($storages)]);
            $smartphone->setState($states[array_rand($states)]);
            $smartphone->setCategory($categories[array_rand($categories)]);
            $smartphone->setCity($this->getReference("city_" . rand(0, 9)));

            $manager->persist($smartphone);
        }


        $manager->flush();
    }
}
