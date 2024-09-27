<?php

namespace App\DataFixtures;

use App\Entity\Image;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ImageFixtures extends Fixture
{
    public const IMAGE_REFERENCE = 'image_';
    public function load(ObjectManager $manager): void
    {
        $images = [
            'burger1.jpeg',
            'burger2.jpeg',
            'burger1.jpeg',
            'burger1.jpeg',
            'burger3.jpeg',
            'burger2.jpeg',
            'burger3.jpeg',
            'burger1.jpeg',
        ];

       foreach($images as $index => $imageName) {
            $image = new Image();
            $image->setName($imageName);
            $manager->persist($image);

            $this->addReference(self::IMAGE_REFERENCE . $index, $image);
        }

        $manager->flush();
    }
}


