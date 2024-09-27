<?php

namespace App\DataFixtures;

use App\Entity\Sauce;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SauceFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $sauces = [
            'Mayonnaise',
            'Ketchup',
            'Moutarde',
            'Sauce barbecue',
            'Sauce fromage',
            'Sauce andalouse',
            'Sauce curry',
            'Sauce yogourt',
        ];

        foreach ($sauces as $sauceName) {
            $sauce = new Sauce();
            $sauce->setName($sauceName);
            $manager->persist($sauce);
        }

        $manager->flush();
    }
}
