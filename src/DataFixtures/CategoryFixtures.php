<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $categoryData = [
            "1 - HC" => [0, 0, 0],
            "2 - C" => [90, 165, 20],
            "3 - B" => [165, 255, 40],
            "4 - A" => [255, 375, 60],
            "5 - Premium" => [375, 1000, 80]
        ];

        foreach ($categoryData as $name => $data) {
            $category = new Category();
            $category->setName($name);
            $category->setValMin($data[0]);
            $category->setValMax($data[1]);
            $category->setPrice($data[2]);

            $manager->persist($category);
            $this->addReference("category_" . str_replace(" ", "_", $category->getName()), $category);
        }

        $manager->flush();
    }
}
