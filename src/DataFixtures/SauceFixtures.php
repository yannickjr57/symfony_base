<?php

namespace App\DataFixtures;

use App\Entity\Sauce;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SauceFixtures extends Fixture
{
    public const SAUCE_REFERENCE = 'sauce_';
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

        foreach ($sauces as $index => $sauceName) {
            $sauce = new Sauce();
            $sauce->setName($sauceName);
            $manager->persist($sauce);

            // Enregistrer une sélection pour cette sauce
            $this->addReference(self::SAUCE_REFERENCE . $index, $sauce);
        }

        $manager->flush();
    }
}
