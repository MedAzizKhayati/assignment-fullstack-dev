<?php

namespace App\DataFixtures;

use App\Entity\BookFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $data = BookFactory::create(
            "Five Shades of Black",
            ["John Doe"],
            new \DateTime("2021-01-01")
        );

        $manager->persist($data);
        $manager->flush();
    }
}
