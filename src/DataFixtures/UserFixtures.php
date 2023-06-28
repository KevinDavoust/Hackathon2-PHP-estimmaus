<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        $admin = new User();
        $admin->setEmail($faker->email());
        $admin->setPassword($this->hasher->hashPassword($admin, "password"));
        $admin->setRoles(["ADMIN"]);
        $manager->persist($admin);

        $volunteerAmount = 3;
        for ($i = 0; $i < $volunteerAmount; $i++)
        {
            $volunteer = new User();
            $volunteer->setEmail($faker->email());
            $volunteer->setPassword($this->hasher->hashPassword($volunteer, "password"));
            $manager->persist($volunteer);
        }

        $manager->flush();
    }
}
