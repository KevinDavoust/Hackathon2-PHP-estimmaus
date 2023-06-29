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
        $admin->setEmail('admin@estimmaus.com');
        $admin->setPassword($this->hasher->hashPassword($admin, "password"));
        $admin->setRoles(["ROLE_ADMIN"]);
        $admin->setCity($this->getReference("city_8"));
        $manager->persist($admin);

        $volunteerAmount = 3;
        for ($i = 0; $i < $volunteerAmount; $i++)
        {
            $volunteer = new User();
            $volunteer->setEmail('volunteer' . $i . '@estimmaus.com');
            $volunteer->setPassword($this->hasher->hashPassword($volunteer, "password"));
            $volunteer->setCity($this->getReference("city_" . $i));
            $manager->persist($volunteer);
        }

        $manager->flush();
    }
}
