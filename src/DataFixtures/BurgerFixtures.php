<?php

namespace App\DataFixtures;

use App\Entity\Burger;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BurgerFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $burgers = [
            [
                'name' => 'Classique',
                'price' => 10,
            ],
            [
                'name' => 'Cheeseburger',
                'price' => 12,
            ],
            [
                'name' => 'Bacon cheeseburger',
                'price' => 15,
            ],
            [
                'name' => 'Burger au fromage de chèvre',
                'price' => 13,
            ],
            [
                'name' => 'Burger aux oignons',
                'price' => 11,
            ],
            [
                'name' => 'Burger au BBQ',
                'price' => 14,
            ],
            [
                'name' => 'Burger aux champignons',
                'price' => 12,
            ],
        ];

        foreach ($burgers as $burgerData) {
            $burger = new Burger();
            $burger->setName($burgerData['name']);
            $burger->setPrice($burgerData['price']);
            $manager->persist($burger);
        }

        $manager->flush();
    }
}
