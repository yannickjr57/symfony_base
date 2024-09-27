<?php

namespace App\DataFixtures;

use App\Entity\Burger;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class BurgerFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $burgers = [
            [
                'name' => 'Classique',
                'price' => 10,
                'pain_reference' => 'pain_0', // Utiliser la référence pour associer le pain
                'oignon_references' => ['oignon_0'],
                'sauce_reference' => 'sauce_0',
                'image_reference' => null,
            ],
            [
                'name' => 'Cheeseburger',
                'price' => 12,
                'pain_reference' => 'pain_1',
                'oignon_references' => ['oignon_1', 'oignon_2'],
                'sauce_reference' => 'sauce_1',
                'image_reference' => 'image_1',
            ],
            [
                'name' => 'Bacon cheeseburger',
                'price' => 15,
                'pain_reference' => 'pain_2',
                'oignon_references' => ['oignon_2'], 
                'sauce_reference' => 'sauce_2',
                'image_reference' => 'image_2',
            ],
            [
                'name' => 'Burger au fromage de chèvre',
                'price' => 13,
                'pain_reference' => 'pain_0',
                'oignon_references' => ['oignon_0', "oignon_3"],
                'sauce_reference' => 'sauce_3',
                'image_reference' => null,
            ],
            [
                'name' => 'Burger aux oignons',
                'price' => 11,
                'pain_reference' => 'pain_1',
                'oignon_references' => ['oignon_2', 'oignon_1'],
                'sauce_reference' => 'sauce_3',
                'image_reference' => null,
            ],
            [
                'name' => 'Burger au BBQ',
                'price' => 14,
                'pain_reference' => 'pain_2',
                'oignon_references' => ['oignon_3'],
                'sauce_reference' => 'sauce_0',
                'image_reference' => 'image_0',
            ],
            [
                'name' => 'Burger aux champignons',
                'price' => 12,
                'pain_reference' => 'pain_0',
                'oignon_references' => ['oignon_1', 'oignon_4'],
                'sauce_reference' => 'sauce_1',
                'image_reference' => null,
            ],
        ];

        foreach ($burgers as $index => $burgerData) {
            $burger = new Burger();
            $burger->setName($burgerData['name']);
            $burger->setPrice($burgerData['price']);
            $burger->setPain($this->getReference($burgerData['pain_reference']));

            // Ajouter les oignons
            foreach ($burgerData['oignon_references'] as $oignonReference) {
                $burger->setOignons($this->getReference($oignonReference));
            }

            $burger->setSauces($this->getReference($burgerData['sauce_reference']));

             // Set the image if it exists
    if ($burgerData['image_reference']) {
        $burger->setImage($this->getReference($burgerData['image_reference']));
    }

            $manager->persist($burger);
        
            // Ajoutez une référence pour chaque burger
            $this->addReference('burger_' . $index, $burger);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            PainFixtures::class,
            OignonFixtures::class,
            SauceFixtures::class,
            ImageFixtures::class
        ];
    }
}
