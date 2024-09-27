<?php

namespace App\DataFixtures;

use App\Entity\Image;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ImageFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $images = [
            'burger1.jpg',
            'burger2.jpg',
            'burger3.jpg',
            'burger4.jpg',
            'burger5.jpg',
            'burger6.jpg',
            'burger7.jpg',
            'burger8.jpg',
        ];

        foreach ($images as $imageName) {
            $image = new Image();
            $image->setName($imageName);
            $manager->persist($image);
        }

        $manager->flush();
    }
}
