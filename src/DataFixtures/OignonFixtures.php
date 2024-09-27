<?php

namespace App\DataFixtures;

use App\Entity\Oignon;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OignonFixtures extends Fixture
{
    public const OIGNON_REFERENCE = 'oignon_';
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

        foreach ($oignons as $index => $oignonName) {
            $oignon = new Oignon();
            $oignon->setName($oignonName);
            $manager->persist($oignon);

            // Enregistrer une sélection pour ce oignon
            $this->addReference(self::OIGNON_REFERENCE . $index, $oignon);
        }

        $manager->flush();
    }
}
