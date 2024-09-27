<?php

namespace App\DataFixtures;

use App\Entity\Oignon;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OignonFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $oignons = [
            'Oignon rouge',
            'Oignon jaune',
            'Oignon blanc',
            'Oignon nouveau',
            'Oignon doux',
            'Oignon rosé',
            'Oignon gris',
        ];

        foreach ($oignons as $oignonName) {
            $oignon = new Oignon();
            $oignon->setName($oignonName);
            $manager->persist($oignon);
        }

        $manager->flush();
    }
}
